<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bilansa-Home</title>
<link href="https://fonts.googleapis.com/css?family=Faster+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
<meta name="Jasminko Vidaković" content="your name" />
<meta name="description" content="" />
<link rel="stylesheet" href="index_style.css" type="text/css" />

</head>

<?php

	function AvoidXSS($unos) 
		{
			$unos = htmlspecialchars($unos);
			return $unos;
		}
	
	if(!isset($_SESSION['login']) && isset($_POST['username']) && isset($_POST['password']))
	{
        $username = AvoidXSS($_POST['username']);
        $password = AvoidXSS($_POST['password']);
		
		$dePoveziSe= new PDO("mysql:dbname=bilansa;host=localhost;charset=utf8", "jasminko", "vidakovic");
		
		$userRowAdmins = $dePoveziSe->prepare("SELECT * FROM admins WHERE username='".$username."' AND password=?");
		$userRowAdmins->bindParam(1, $password, PDO::PARAM_STR);
		$userRowAdmins->execute();
		$resultAdmins = $userRowAdmins->fetch();

		$userRowClients = $dePoveziSe->prepare("SELECT * FROM online_klijenti WHERE username='".$username."' AND password=?");
		$userRowClients->bindParam(1, $password, PDO::PARAM_STR);
		$userRowClients->execute();
		$resultClients = $userRowClients->fetch();		

		if($userRowAdmins->rowCount() == 1)
		{
            session_start();
            $_SESSION['login'] = $resultAdmins['username'];
            header("Location: admin.php");
            exit();
        }
		else if($userRowClients->rowCount() == 1)
		{
			session_start();
            $_SESSION['login'] = $resultClients['username'];
            header("Location: user.php");
            exit();
		}
		else if($username != $resultAdmins['username'] || $password != $resultAdmins['password'] || $username != $resultClients['username'] || $password != $resultClients['password'] )
		{
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pogrešni login podaci!";
        }

    }
	else if (isset($_SESSION['login']))
	{
		
		$dePoveziSe= new PDO("mysql:dbname=bilansa;host=localhost;charset=utf8", "jasminko", "vidakovic");
		
		$userRowAdmins = $dePoveziSe->prepare("SELECT * FROM admins WHERE username='".$_SESSION['login']."'");
		$userRowAdmins->execute();
		$resultAdmins = $userRowAdmins->fetch();

		$userRowClients = $dePoveziSe->prepare("SELECT * FROM online_klijenti WHERE username='".$_SESSION['login']."'");
		$userRowClients->execute();
		$resultClients = $userRowClients->fetch();	
		
		echo "<script type='text/javascript'>
			function hideLogin()
			{
				document.getElementById('loginInputs').style.display = 'none';
				document.getElementById('sub_content').innerHTML = '<br>&nbsp;&nbsp;&nbsp;Logirani ste!</br>';
			}
			</script>";
		if($_SESSION['login']==$resultAdmins['username']) 
		{
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prijavljeni ste kao korisnik&nbsp;&nbsp;&nbsp;<b><body><i><u>".$_SESSION['login']."</u></i>&nbsp;&nbsp;&nbsp;&nbsp;|";
			echo "<a href='logout.php'>&nbsp;&nbsp;&nbsp;&nbsp;<b style='color:red;'>Odjava</b></a>&nbsp;&nbsp;&nbsp;&nbsp;|";
			echo "<a href='admin.php'>&nbsp;&nbsp;&nbsp;&nbsp;<b style='color:blue;'>Dashboard (admin)</b></a>";
		}
		else if($_SESSION['login']==$resultClients['username'])
		{
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prijavljeni ste kao korisnik&nbsp;&nbsp;&nbsp;<b><body><i><u>".$_SESSION['login']."</u></i>&nbsp;&nbsp;&nbsp;&nbsp;|";
			echo "<a href='logout.php'>&nbsp;&nbsp;&nbsp;&nbsp;<b style='color:red;'>Odjava</b></a>&nbsp;&nbsp;&nbsp;&nbsp;|";
			echo "<a href='user.php'>&nbsp;&nbsp;&nbsp;&nbsp;<b style='color:blue;'>Dashboard (user)</b></a>";
		}
	}
	else if(isset($_SESSION['login']) && !isset($_POST['username']) && !isset($_POST['username']))
	{
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pogrešni login podaci!";
	}
	else if(!isset($_SESSION['login']) && !isset($_POST['username']) && !isset($_POST['username']))
	{
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Niste prijavljeni na portal";
	}


?>
<body onload="hideLogin()">
	<div id="page">
		<div id="zaglavlje">
		<div id="logo_text">
			<h1 id="agencija"><i>AGENCIJA ZA KNJIGOVODSTVO</i></h1><br><br><br><br>
			<h1 id="slovo_i"><i>i</i></h1><br><br><br><br>
			<h1 id="finan_usl"><i>FINANSIJSKE USLUGE</i></h1>
			<h1 id="bilansa"><i>" Bilansa "</i></h1>
		</div>
		<div id="logo_slika"><img id="slikaLogo" src="noviLogo.png" width="320" height="160" alt="Slika"></div>
		<div id="nav">
			<ul>
				<li><a id="index_button" href="index.php">Početna</a></li>
				<li><a id="about_button" href="about.html">O nama</a></li>
				<li><a id="contact_button" href="contact.html">Kontakt</a></li>
				<li><a id="download_button" href ="download.html">Download</a></li>
				<li><a id="pricing_button" href ="pricing.html">Cjenik</a></li>
				<li><a id="slideshow_button" href="slideshow.html" target="_blank">Galerija</a></li>
			</ul>	
		</div>
		</div>
		<div id="content">
			<h2><b>Početna stranica</b></h2>
			<br>
			<div id="uvod">
			<p id="dobro_dosli">
				<b><i>Dobro došli na stranicu naše Agencije !</i></b>
				<br>
				<b><i>Ovdje možete pronaći sve informacije vezane za Agenciju, kao i kontakt informacije.</i></b>
				<br><br>
				<b><i>Pratite novosti s našeg YouTube kanala, posjetite našu Facebook stranicu i pogledajte atmosferu u našoj kancelariji kroz slideshow .</i></b>
				<br><br>
				<b><i>Želimo Vam ugodnu posjetu :) .</i></b>
			</p>
			</div>
			
		</div>
		<div id="sub_content">
			<form name="logingIn" action="index.php" method="post">
			<div id="popupPrijava" class="popupPrijava">
			<div id="loginInputs">
				<h2><b>Prijava</b></h2>
				<b><i>&nbsp;Unesite korisničko ime i šifru.</i></b><br><br><br>
				<b><i>&nbsp;Username:&nbsp;&nbsp;&nbsp;<input id="username" name="username" type="text"></i></b><br><br>
				<b><i>&nbsp;Password:&nbsp;&nbsp;&nbsp;<input id="password" name="password" type="password"></i></b><br><br>
				<br>
				&nbsp;<input id="SubmitLogin" type="submit" value="Potvrdi unos"/>
			</div>
			</div>
			</form>	
		</div>
		<div id="yt_video_div">
				<iframe width="480" height="400" src="https://www.youtube.com/embed/h4WcqLtOabM">
				</iframe>
		</div>
		<div id="footer">
			<p>
				Webpage made by <b><i>Jasminko Vidaković</i></b>
			</p>
		</div>
	</div>
</body>
</html>