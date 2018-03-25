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
		
		$recepientRows = $connect->prepare("SELECT email FROM klijenti, online_klijenti, mailing_lista WHERE 
							mailing_lista.online_klijent_id = online_klijenti.id AND online_klijenti.klijent_id = klijenti.id");
		$recepientRows->execute();
		
		$resultRecepient = $recepientRows->fetchAll();
		
		$connect = new PDO("mysql:dbname=bilansa;host=localhost;charset=utf8", "jasminko", "vidakovic");
		
		$recepientRows = $connect->prepare("SELECT * FROM klijenti, online_klijenti, mailing_lista WHERE 
							mailing_lista.online_klijent_id = online_klijenti.id AND online_klijenti.klijent_id = klijenti.id");
		
		$recepientRows->execute();
		
		$resultRecepient = $recepientRows->fetchAll(PDO::FETCH_ASSOC);
		
		echo "<p><b>Primatelji:</b></p><br>";
		
		foreach($resultRecepient as $entry)
		{
			echo $entry['email'];
			echo "<br>";
		}
		
		echo "<br><br>";
		
		echo "Ukupan broj primatelja na listi: &nbsp;&nbsp; ".$recepientRows->rowCount()."";
		echo "<br><br>";
		echo "<a href='group_email.php'>Povratak nazad</a>";
		
	}


?>