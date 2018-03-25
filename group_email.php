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
	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mailing</title>
		<script type="text/javascript" src="contact_form.js" charset="UTF-8"></script>
</head>

	<p>Slanje grupnog email-a klijentima</p><br>
	<a href='mailing_list.php'>Lista primatelja</a><br><br>
	<a href='admin.php'>Povratak na dashboard</a><br>
	
	<form name="groupMailForm" action="group_email.php" method="post"><br>
	<p>Predmet (*):&nbsp;&nbsp; <input id="subject" name="subject" type="text"><br><br>
	<textarea id="poruka_email" name="poruka_email" cols="100" rows="10"></textarea><br><br>
	<input id='sendMail' type='submit' value='Pošalji'/><br>
	</form>







<?php
	
	function AvoidXSS($unos) 
	{
		$unos = htmlspecialchars($unos);
		return $unos;
	}

	if(isset($_SESSION['login']) && $_SESSION['login'] == 'jasminko' && isset($_POST['subject']) && isset($_POST['poruka_email']))
	{
		
		$predmet = AvoidXSS($_POST['subject']);
		$poruka = AvoidXSS($_POST['poruka_email']);
				  
		
		$connect = new PDO("mysql:dbname=bilansa;host=localhost;charset=utf8", "jasminko", "vidakovic");
		
		$recepientRows = $connect->prepare("SELECT email FROM klijenti, online_klijenti, mailing_lista WHERE 
							mailing_lista.online_klijent_id = online_klijenti.id AND online_klijenti.klijent_id = klijenti.id");
		$recepientRows->execute();
		
		$resultRecepient = $recepientRows->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($resultRecepient as $entry)
		{
			mail($entry['email'], $predmet, $poruka);
		}
		
	}


?>