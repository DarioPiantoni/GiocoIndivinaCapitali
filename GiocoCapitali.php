<?php
	require("Capitale.php");
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Gioco capitali</title>
		<?php
			$mysqli=new mysqli("localhost","root","","newworld");
			
			if(isset($_SESSION["continente"])==false)
			{
				$_SESSION["continente"]=$_POST["continente"];

				$posizioniUscite=array();
				$_SESSION["posizioniUscite"]=$posizioniUscite;
				
				$_SESSION["giocate"]=0;
				$_SESSION["punteggio"]=0;
				
				//prendo le capitali di un continente
				
				$stmt=$mysqli->prepare("SELECT
											city.Id,city.Name,country.Name
										FROM
											country,city
										WHERE
											country.Capital=city.ID
										AND
											country.Continent=(?)");
				$stmt->bind_param("s",$_SESSION["continente"]);
				$stmt->execute();
				$stmt->bind_result($id,$nomeCapitale,$nomeNazione);
				
				$capitali=array();
				while($stmt->fetch())
				{
					$c=new Capitale($id,$nomeCapitale,$nomeNazione);
					array_push($capitali,$c);
				}
				$_SESSION["capitali"]=$capitali;
				
			}
			else
			{
				$capitali=$_SESSION["capitali"];
				$posizioniUscite=$_SESSION["posizioniUscite"];
			}
		?>
	</head>
	<body>
		<h1>Gioco capitali</h1>
		<?php
			do{
				$numeroGenerato=rand(0,count($capitali)-1);
				
				$duplicato=in_array($numeroGenerato,$posizioniUscite);
				if($duplicato==false)
				{
					array_push($posizioniUscite,$numeroGenerato);
					$_SESSION["numeroGenerato"]=$numeroGenerato;
					$_SESSION["posizioniUscite"]=$posizioniUscite;
				}
			}while($duplicato==true);
			
			$elencoNazioniSelezionabili=array($numeroGenerato);
			for($i=0;$i<3;$i++)
			{
				do{
					$n=rand(0,count($capitali)-1);
					$duplicato=in_array($n,$elencoNazioniSelezionabili);
					if($duplicato==false)
						array_push($elencoNazioniSelezionabili,$n);
				}while($duplicato==true);
			}
			
			shuffle($elencoNazioniSelezionabili);//ordina a caso il vettore
		?>
		
		<?php
			if($_SESSION["giocate"]<10)
			{
				echo "<h2>Continente: ".$_SESSION["continente"]."</h2>";
				echo "Seleziona la nazione per la capitale ".$capitali[$numeroGenerato]->getNome()."<br>";
				echo "<form method='POST' action='ElaboraGioco.php'>";
				for($i=0;$i<count($elencoNazioniSelezionabili);$i++)
				{
					echo "<input type='radio' name='nazione' value='".$elencoNazioniSelezionabili[$i]."'>";
					echo $capitali[$elencoNazioniSelezionabili[$i]]->getNomeNazione()."<br>";
				}
				echo "<br>";
				echo "<input type='submit' name='azione' value='Invia'>";
				echo "</form>";
			}
			else
			{
				echo "<h1>Partita terminata</h1>";
				echo "<form method='POST' action='FormContinente.php'>";
				echo "<input type='submit' name='nuovaPartita' value='Nuova partita'>";
			    echo "</form>";
			}
			
			echo "<p>Giocate: ".$_SESSION["giocate"]."</p>";
			echo "<p>Punteggio: ".$_SESSION["punteggio"]."</p>";
		?>
	</body>
</html>