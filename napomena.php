<?php

	session_start();
	
	function AvoidXSS($unos) 
		{
			$unos = htmlspecialchars($unos);
			return $unos;
		}

	if(isset($_SESSION['login']) && isset($_POST['napomena']) && $_SESSION['login'] == 'jasminko')
	{
		$number = AvoidXSS($_GET['koji']);
	
		$xmlDoc = new DOMDocument();
		$xmlDoc->preserveWhiteSpace = false;
		$xmlDoc->formatOutput = true;
		$xmlDoc->Load('poruke.xml');	
	
		$root = $xmlDoc->getElementsByTagName('sve_poruke')->item(0);
		$poruka = $root->getElementsByTagName('poruka')->item(intval($number));
		$napomena = $poruka->getElementsByTagName('napomena')->item(0)->nodeValue = $_POST['napomena'];
			
		$xmlDoc->save('poruke.xml');	
	
		echo "Promjena je izvršena!<br><br>";
		echo "<a href='admin.php'>Povratak na dashboard</a>";
	}
	else
	{
		header("Location: index.php");
	}
	
	
?>