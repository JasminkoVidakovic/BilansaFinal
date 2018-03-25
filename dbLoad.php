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
		echo "<p> Uradjeno! ! </p>";
		echo "<a href='admin.php'>Povratak na dashboard</a>"; 
		
		if(file_exists('poruke.xml'))
		{
			$connect = new PDO("mysql:dbname=bilansa;host=localhost;charset=utf8", "jasminko", "vidakovic");
			
			$xmlDoc=new SimpleXMLElement('poruke.xml', 0, true);
			
			$result = $connect->prepare("SELECT * FROM poruke");
			$result->execute();
		
			if($result->rowCount() == 0)
			{
				$connect->exec("TRUNCATE TABLE poruke");
			}
			
			try
			{
				$connect = new PDO("mysql:dbname=bilansa;host=localhost;charset=utf8", "jasminko", "vidakovic");
				
				foreach($xmlDoc->poruka as $poruka) 
				{
					$result = $connect->prepare("SELECT * FROM poruke");
					$result->execute();
		
					if($result->rowCount() == 0)
					{
						$connect->exec("TRUNCATE TABLE poruke");
					}
					
					$vec_ima = $connect->prepare("SELECT * FROM poruke WHERE posiljaoc = '".$poruka->ime."' AND telefon = '".$poruka->telefon."' AND
						email = '".$poruka->email."' AND ocjena= '".$poruka->ocjena."' AND tekst = '".$poruka->msg."'");
						
					$vec_ima->execute();
				
					if($vec_ima->rowCount() == 0)
					{	$insertCommand = "INSERT INTO poruke (posiljaoc, telefon, email, ocjena, tekst)
							VALUES ('".$poruka->ime."', '".$poruka->telefon."', '".$poruka->email."', '".$poruka->ocjena."', '".$poruka->msg."')";
						 
						$connect->exec($insertCommand);				
					}						
				}
			}
			catch(PDOException $error)
			{
				echo "Greška u DB-komandi :&nbsp;&nbsp;&nbsp;".$insertCommand."<br>";
				echo "Poruka za grešku :&nbsp;&nbsp;&nbsp;".$error->getMessage()."<br>";
			}
			
			$connect = null;
		}
	}





?>