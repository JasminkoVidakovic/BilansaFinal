<?php

	session_start();
	
	function AvoidXSS($unos) 
		{
			$unos = htmlspecialchars($unos);
			return $unos;
		}

	if(isset($_SESSION['login']) && isset($_GET['msgNum']) && isset($_GET['dbNum']))
	{
		$number = AvoidXSS($_GET['msgNum']);
		$numberDB = AvoidXSS($_GET['dbNum']);
	
		$xmlDoc = new DOMDocument();
		$xmlDoc->preserveWhiteSpace = false;
		$xmlDoc->formatOutput = true;
		$xmlDoc->Load('poruke.xml');
		
		$connect = new PDO("mysql:dbname=bilansa;host=localhost;charset=utf8", "jasminko", "vidakovic");
		
		$connect->exec("DELETE FROM poruke WHERE id='".intval($numberDB+1)."'");
		
		$result = $connect->prepare("SELECT * FROM poruke");
		$result->execute();
		
		if($result->rowCount() == 0)
		{
			$connect->exec("TRUNCATE TABLE poruke");
		}
	
		$root = $xmlDoc->getElementsByTagName('sve_poruke')->item(0);
	
		$poruka = $root->getElementsByTagName('poruka')->item($number);
		$root->removeChild($poruka);
		$xmlDoc->save('poruke.xml');
		
		header("Location: admin.php");
	}
	else
	{
		header("Location: index.php");
	}
	
	
?>