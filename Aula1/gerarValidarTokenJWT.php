<?php

	include_once('vendor/autoload.php');

	$jwt = new stdClass();
	$jwt->id = 10;
	$jwt->nome = 'Luiz';
	$jwt->exp = time() + 60;

	$token = \Firebase\JWT\JWT::encode($jwt, 'webdev'); //variavel para q recebe o token, e a senha utilizada para tal
	echo '<br>'.$token;

	$token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.LNR5zswZAdTq2sEuA8GFxY9iTqeQe-FY29xe-BpZ8WU';
	try {
		$token = \Firebase\JWT\JWT::decode($token, 'webdev', array('HS256'));
		echo '<br>'.'Token válido!';
	}
	catch(Exception $e) {
		echo '<br>'.'Token Inválido';
	}

?>