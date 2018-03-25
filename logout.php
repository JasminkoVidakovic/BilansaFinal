<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Logout</title>
<link href="https://fonts.googleapis.com/css?family=Faster+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
<meta name="Jasminko Vidaković" content="your name" />
<meta name="description" content="" />
</head>
<?php 
    session_start();
    unset($_SESSION['login']);
	session_destroy();
	session_unset();
    header("Location: index.php");
?>
</html>