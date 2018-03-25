<?php
	
	require("tableParser.php");
	
	function AvoidXSS($unos) 
		{
			$unos = htmlspecialchars($unos);
			return $unos;
		}
	
	session_start();
	
	if(isset($_SESSION['login']) && isset($_GET['napravi']) && AvoidXSS($_GET['napravi']) == 1 && file_exists('poruke.xml') && $_SESSION['login'] == 'jasminko')
	{
		$xmlDoc=new SimpleXMLElement('poruke.xml', 0, true);
	
		$csvReport = fopen('izvjestaj.csv', 'w');

		$firstRow = array('Ime', 'Telefon', 'Email', 'Ocjena', 'Tekst');
	
		fputcsv($csvReport, $firstRow);
		
		foreach($xmlDoc->poruka as $poruka) 
		{			
			fputcsv($csvReport, array($poruka->ime,$poruka->telefon,$poruka->email,$poruka->ocjena,$poruka->msg));
		}
		
		fclose($csvReport);
		
		echo "Izvjestaj je kreiran !&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<a href='izvjestaj.csv' target='_blank'><b>Download izvjestaja</b></a>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br><br>";
		echo "<a href='admin.php'>Povratak na dashboard</a>";
	}
	else if(isset($_SESSION['login']) && isset($_GET['napravi']) && AvoidXSS($_GET['napravi']) == 2 && file_exists('poruke.xml') && $_SESSION['login'] == 'jasminko')
	{
		
		$xmlDoc=new SimpleXMLElement('poruke.xml', 0, true);
		
		$pdf = new PDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		
		$pdf->SetAuthor('Jasminko Vidaković');
		$pdf->SetTitle('Izvještaj o porukama');
		$pdf->SetFont('Arial','B',12);
	
		$i = 0;
	
		foreach($xmlDoc->poruka as $poruka) 
		{			
			$i = $i + 1 ;
		
			$ime=$poruka->ime;
			$telefon=$poruka->telefon;
			$email=$poruka->email;
			$ocjena=$poruka->ocjena;
			$tekst=$poruka->msg;
				
			$text =	"<b><u>".$i.". poruka</u></b><br><br>
					Ime i prezime:     ".$poruka->ime."<br><br>
					Broj telefona:      ".$poruka->telefon."<br><br>
					Email:                  ".$poruka->email."<br><br>
					Ocjena:                ".$poruka->ocjena."<br><br>
					Tekst poruke:      ".$poruka->msg."<br><br>";
					
					
			if($i%4!=0)		
			{
				$text = $text."----------------------------------------------------------------------------------------------------<br><br>";
			}
			
			$pdf->WriteHTML($text);

		}
		
		$pdf->Output('izvjestaj.pdf', 'F');
		
		echo "Izvjestaj je kreiran !&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<a href='izvjestaj.pdf' target='_blank'><b>Prikaži izvještaj</b></a>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br><br>";
		echo "<a href='admin.php'>Povratak na dashboard</a>";
	}
	else
	{
		header("Location: index.php");
	}



		



?>
