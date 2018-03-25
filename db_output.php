<?php

	session_start();
	
	if(!isset($_SESSION['login']))
	{ 	
        header("Location: index.php");
        exit();
    }
	else if(isset($_SESSION['login']) && $_SESSION['login'] != 'jasminko')
	{
		header("Location: index.php");
        exit();
	}
	else
	{
		$connect = new PDO("mysql:dbname=bilansa;host=localhost;charset=utf8", "jasminko", "vidakovic");
		
		$porukeRows = $connect->prepare("SELECT * FROM poruke");
		
		$porukeRows->execute();
		
		$porukeResults = $porukeRows->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($porukeResults as $entry)
		{
			echo "ID-broj&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;".$entry ['id']."<br>";
			echo "Posiljaoc:&nbsp;&nbsp;&nbsp;".$entry ['posiljaoc']."<br>";
			echo "Telefon:&nbsp;&nbsp;&nbsp;".$entry ['telefon']."<br>";
			echo "Email&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;".$entry ['email']."<br>";
			echo "Ocjena&nbsp;:&nbsp;&nbsp;&nbsp;".$entry ['ocjena']."<br>";
			echo "Tekst&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;".$entry ['tekst']."<br>";
			echo "------------------------------------------------<br>";
		}
		
		echo "<br><br>";
		echo "Ukupan broj poruka:&nbsp;&nbsp;".$porukeRows->rowCount()."<br><br>"; 
		
		echo "<a href='admin.php'>Povratak na dashboard</a>"; 
		
	}

?>