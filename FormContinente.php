<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Seleziona il continente</title>
		<?php
			$mysqli=new mysqli("localhost","root","","newworld");
			
			if(isset($_POST["nuovaPartita"]))
				unset($_SESSION["continente"]);
		?>
	</head>
	<body>
		<h1>Gioco capitali</h1>
		<form method="POST" action="GiocoCapitali.php">
			Seleziona il continente:
			<select name="continente">
				<?php
					$risultato=$mysqli->query("SELECT
													country.Continent
											   FROM
													country
											   GROUP BY
													country.Continent
											   HAVING
													COUNT(*)>=10
											   ORDER BY
													country.Continent ASC");
					while($riga=$risultato->fetch_assoc())
						echo "<option value='".$riga["Continent"]."'>".$riga["Continent"]."</option>";
				?>
			</select>
			<br>
			<input type="submit" name="azione" value="Inizia il gioco">
		</form>
	</body>
</html>