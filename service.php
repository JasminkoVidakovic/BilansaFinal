<?php
	
	function zag() 
	{
		header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
	}
	
	function rest_get($data) 
	{
	
		$connect = new PDO("mysql:dbname=bilansa;host=localhost;charset=utf8", "jasminko", "vidakovic");
		
		$klijentiRow = $connect->prepare("SELECT * FROM klijenti WHERE id='".intval($data)."'");
		
		$klijentiRow->execute();
		
		$porukeResults = $klijentiRow->fetch(PDO::FETCH_ASSOC);
		
		echo json_encode($porukeResults);
		}

	$method  = $_SERVER['REQUEST_METHOD'];
	$request = $_SERVER['REQUEST_URI'];

	switch($method) 
	{	
		case 'PUT':
			exit();
			break;
			
		case 'POST':
			exit();
			break;
			
		case 'GET':			
			zag(); 
			$data = $_GET['id']; 
			rest_get($data); 
			break;
			
		case 'DELETE':
			exit();
			break;
			
		default:
			header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
			rest_error($request); break;
	}

?>