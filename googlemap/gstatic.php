<?php
$allowedAddress = array("www.pinoydestination.com","test.pinoydestination.com","localhost","localhost:8080","localhost:8082");
if(isset($_SERVER['HTTP_REFERER'])){
	$ref = $_SERVER['HTTP_REFERER'];


	$allowed = false;
	if($ref){
		$ref = explode("/",$ref);
		foreach($ref as $reference){
			if(in_array($reference,$allowedAddress)){
				$allowed = true;
			}
		}
		if(!$allowed){
			die("<style>font-family:Arial, Helvetica, sans-serif; font-size:11px;</style>You are not allowed to access this page. Visit <a href='http://www.pinoydestination.com/'>www.PinoyDestination.com</a> to view content.");
		}

	}

}

if(isset($_SERVER['HTTP_REFERER'])){
	$ref = $_SERVER['HTTP_REFERER'];


	/*
	if($ref){
		$ref = explode("/",$ref);
		if(in_array("www.pinoydestination.com",$ref)){
		
		}else if(in_array("localhost",$ref)){

		}else if(in_array("localhost:8082",$ref)){

		}else{
			die("You are not allowed to access this page. Visit www.PinoyDestination.com to gain access.");
		}
	}*/

	if($ref){
		$ref = explode("/",$ref);

		foreach($ref as $reference){
			if(in_array($reference,$allowedAddress)){
				$allowed = true;
			}
		}
		if(!$allowed){
			die("<style>font-family:Arial, Helvetica, sans-serif; font-size:11px;</style>You are not allowed to access this page. Visit <a href='http://www.pinoydestination.com/'>www.PinoyDestination.com</a> to view content.");
		}

	}

}

if(!isset($_GET['address'])){
	die("required param not found");
}
$zoom = $_GET['zoom'];
$address = urlencode($_GET['address']);
$size = isset($_GET['size']) ? $_GET['size'] : '400x300';

if(isset($_GET['datatype']) && $_GET['datatype'] == "latlang"){
	$name = 'http://maps.googleapis.com/maps/api/staticmap?zoom='.$zoom.'&size='.$size.'&maptype=roadmap&markers=color:blue|label:Destination|'.str_replace(", ",",",urldecode($address)).'&sensor=true&key=AIzaSyAWo2NkY1CvmTYlKZRwS0P5ZfMSE5wLiiE';
}else{
	$name = 'http://maps.googleapis.com/maps/api/staticmap?center='.$address.'&markers='.$address.'&zoom='.$zoom.'&size='.$size.'&key=AIzaSyAWo2NkY1CvmTYlKZRwS0P5ZfMSE5wLiiE&sensor=true';
}

$fp = fopen($name, 'rb');

header("Content-Type: image/jpg");
header("Content-Length: " . filesize($name));

fpassthru($fp);