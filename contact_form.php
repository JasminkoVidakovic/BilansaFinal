<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contact Us</title>
	<meta name="author" content="your name" />
		<meta name="description" content="" />
		<link rel="stylesheet" href="contact_form_style.css" type="text/css" />
		<script type="text/javascript" src="contact_form.js" charset="UTF-8"></script>
</head>
	<?php

		$nazivDokumenta = "poruke.xml"; 
		
		function AvoidXSS($unos) 
		{
			$unos = htmlspecialchars($unos);
			return $unos;
		}
		
		if(isset($_REQUEST['ime']) && isset($_REQUEST['telefon']) && isset($_REQUEST['email']) && isset($_REQUEST['ocjena']) && isset($_REQUEST['msg']))
		{
			if(!preg_match("/^[a-zA-Z ]+$/",$_REQUEST['ime'])) { $imeGreska = "Ovo polje može sadržavati samo velika/mala slova i razmak!"; exit();}
			if(!preg_match("/^\(?[0]{1}[0-9]{2}(\/|\)) ?[0-9]{3}-[0-9]{3}$/",$_REQUEST['telefon'])) { $telefonGreska = "Broj telefona u formatu 0xx/xxx-xxx, x moze biti samo cifra 0-9"; exit();}
			if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,8}$/",$_REQUEST['email'])) { $emailGreska = "Unesite validnu email adresu"; exit();}
			if(!preg_match("/^[0-5]{1}$/",$_REQUEST['ocjena'])) {$ocjenaGreska = "Unesite brojeve 0-5"; exit();}
			if(!preg_match("/^^(?!\s*$).+$/",$_REQUEST['msg']) ){$msgGreska = "Unesite neku poruku"; exit();} 
		}
		
		if (!file_exists($nazivDokumenta)) 
		{			
			$xmlDoc = new DOMDocument('1.0','utf-8');
			$root_poruke = $xmlDoc->createElement('sve_poruke');
			$xmlDoc->appendChild($root_poruke);
			$xmlDoc->preserveWhiteSpace = false;
			$xmlDoc->formatOutput = true;
			$xmlDoc->save('poruke.xml');
		}
		if(isset($_REQUEST['ime']) && isset($_REQUEST['telefon']) && isset($_REQUEST['email']) && isset($_REQUEST['ocjena']) && isset($_REQUEST['msg']))
		{
			$ime = AvoidXSS($_REQUEST['ime']);
			$telefon = AvoidXSS($_REQUEST['telefon']);
			$email = AvoidXSS($_REQUEST['email']);
			$ocjena = AvoidXSS($_REQUEST['ocjena']);
			$msg = AvoidXSS($_REQUEST['msg']);
			$i=0;
			
			$xmlDoc = new DOMDocument();
			$xmlDoc->preserveWhiteSpace = false;
			$xmlDoc->formatOutput = true;
			$xmlDoc->Load('poruke.xml');
			
						
			$xmlDocc=new SimpleXMLElement('poruke.xml', 0, true);	
	
			foreach($xmlDocc->poruka as $poruka) 
			{			
				$i = $i + 1;
			}
			
		
			$porukaTag = $xmlDoc->createElement('poruka');
	
			$brojTag = $xmlDoc->createElement('broj');
			$brojTagValue = $xmlDoc->createTextNode($i);
			$brojTag->appendChild($brojTagValue);			
			
			$imeTag = $xmlDoc->createElement('ime');
			$imeTagValue = $xmlDoc->createTextNode($ime);
			$imeTag->appendChild($imeTagValue);
			
			$telefonTag = $xmlDoc->createElement('telefon');
			$telefonTagValue = $xmlDoc->createTextNode($telefon);
			$telefonTag->appendChild($telefonTagValue);
			
			$emailTag = $xmlDoc->createElement('email');
			$emailTagValue = $xmlDoc->createTextNode($email);
			$emailTag->appendChild($emailTagValue);
			
			$ocjenaTag = $xmlDoc->createElement('ocjena');
			$ocjenaTagValue = $xmlDoc->createTextNode($ocjena);
			$ocjenaTag->appendChild($ocjenaTagValue);
			
			$msgTag = $xmlDoc->createElement('msg');
			$msgTagValue = $xmlDoc->createTextNode($msg);
			$msgTag->appendChild($msgTagValue);
			
			$napomenaTag = $xmlDoc->createElement('napomena');
			$napomenaTagValue = $xmlDoc->createTextNode('');
			$napomenaTag->appendChild($napomenaTagValue);
		
			$porukaTag->appendChild($brojTag);
			$porukaTag->appendChild($imeTag);
			$porukaTag->appendChild($telefonTag);
			$porukaTag->appendChild($emailTag);
			$porukaTag->appendChild($ocjenaTag);
			$porukaTag->appendChild($msgTag);
			$porukaTag->appendChild($napomenaTag);
		
			$root_poruke=$xmlDoc->getElementsByTagName('sve_poruke'); 
			$root_poruke[0]->appendChild($porukaTag);
			$xmlDoc->appendChild($root_poruke[0]);
			$xmlDoc->preserveWhiteSpace = false;
			$xmlDoc->formatOutput = true;

			$xmlDoc->save('poruke.xml');
			
			
			
			$connect = new PDO("mysql:dbname=bilansa;host=localhost;charset=utf8", "jasminko", "vidakovic");
			
			$result = $connect->prepare("SELECT * FROM poruke");
			$result->execute();
		
			if($result->rowCount() == 0)
			{
				$connect->exec("ALTER TABLE poruke AUTO_INCREMENT=1");
			}
			
			$insertCommand = "INSERT INTO poruke (posiljaoc, telefon, email, ocjena, tekst)
							VALUES ('".$ime."', '".$telefon."', '".$email."', '".$ocjena."', '".$msg."')";
						 
			$connect->exec($insertCommand);
			
			
			
			
		}
	?>
	
	<body>
			<form name="mainForm" onsubmit="return ValidateName()" action="contact_form.php" method="post">
				<div id="unosi">
				<div id="ime_prezime">
					<p>Ime i prezime (*):&nbsp;&nbsp; <input id="ime" name="ime" oninput="CheckName()" onchange="CheckName()" type="text">
					<p>Broj telefona (*):&nbsp;&nbsp;&nbsp;&nbsp; <input id="tel" type="text" name="telefon" oninput="CheckPhone()" onchange="CheckPhone()">
					<p>Email (*):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input id="email" name="email" type="text" oninput="CheckMail()" onchange="CheckMail()">
					<p>Vaša ocjena (1-5):&nbsp; <input type="text" id="ocjena" name="ocjena" value="0" oninput="CheckGrade()" onchange="CheckGrade()"></p>
					<p>Ostavite "0" ako nas ne želite ocijeniti</p>
					<br><br>
					<p>Vaša poruka (*):</p>
					<textarea id="poruka" name="msg" cols="100" rows="10" oninput="CheckMsg()" onchange="CheckMsg()"></textarea>
					<br><br>
					<input id="potvrdi" type="submit" value="Potvrdi"/>
					<input id="ponisti" type="reset" value="Poništi"/>
					<br><br><br>
					<button id="povratak" type="button" action="contact.html" onclick="window.open('', '_self', ''); window.close();">Povratak nazad</button>
				</div>
				</div>
			</form>
	</body>
	</html>