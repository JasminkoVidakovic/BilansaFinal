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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>...</title>
</head>
<body>
<p>Unesite napomenu:<br><br></p>
<p>Ukoliko želite ukloniti staru napomenu, ostavite prazno polje.</p>
<form name="nebitno" action="napomena.php?koji=<?php echo "".$_GET['broj'] ?>" method="post">
<input type="text" id="idNapomena" name="napomena">
<input type="submit" id="idPromjena" value="Promjena"/>
</form>
</body>
</html>

