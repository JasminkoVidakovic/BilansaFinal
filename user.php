<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact Us</title>
		<link rel="stylesheet" href="contact_form_style.css" type="text/css" />
		<script type="text/javascript" src="contact_form.js" charset="UTF-8"></script>
</head>
<?php
	
    if(!isset($_SESSION['login']))
	{ 	
        header("Location: index.php");
        exit();
    }
	else if(isset($_SESSION['login']) && $_SESSION['login'] != 'jasminko')
	{
		echo "<p> User dashboard ! </p>";
		echo "<a href='index.php'>Povratak na početni page</a><br><br>";
		echo "<a href='logout.php'>Logout</a><br><br><br><br><br>";
	
	}
	else
	{
		header("Location: index.php");
        exit();
	}

?>
	<body>
			
	
	</body>
</html>