<?php
	require("Capitale.php");
	session_start();
	
	if(isset($_POST["azione"]) && isset($_POST["nazione"]))
	{
		$idCapitale=$_POST["nazione"];
		$capitali=$_SESSION["capitali"];
		
		if($capitali[$_SESSION["numeroGenerato"]]->getNome()==$capitali[$idCapitale]->getNome())
			$_SESSION["punteggio"]+=1;
		
		$_SESSION["giocate"]++;
	}
	else
		$_SESSION["giocate"]++;
	header("Location:GiocoCapitali.php");
		
?>