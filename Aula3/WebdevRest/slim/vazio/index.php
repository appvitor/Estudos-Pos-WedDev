<?php

	include_once("../../vendor/autoload.php");

	use Psr\Http\Message\RequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;


	$app = new \Slim\App();

	//rotas

	$app->run();

?>