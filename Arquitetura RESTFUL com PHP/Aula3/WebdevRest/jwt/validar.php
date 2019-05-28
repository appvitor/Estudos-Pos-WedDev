<?php

	include_once("../vendor/autoload.php");

	$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MTAsIm5vbWUiOiJMdWl6IiwiZXhwIjoxNTUwMzI0NTkwfQ.Ixra8Bbl3OyWINjqD8BWEK52qZuRi6sH55hBKZVhVTk";
	
	try{
		$jwt = \Firebase\JWT\JWT::decode($token, "webdev", array("HS256"));
		var_dump($jwt);
	}catch(Exception $e){
		echo "Token inválido";
	}

?>