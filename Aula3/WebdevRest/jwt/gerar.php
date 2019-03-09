<?php

	include_once("../vendor/autoload.php");

	$jwt = new stdClass();
	$jwt->id 	= 10;
	$jwt->nome 	= "Luiz";
	$jwt->exp 	= time() + 60;

	$token = \Firebase\JWT\JWT::encode($jwt, "webdev");

	echo $token;



?>