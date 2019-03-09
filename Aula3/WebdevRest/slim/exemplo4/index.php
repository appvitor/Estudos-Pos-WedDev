<?php

	include_once("../../vendor/autoload.php");

	use Psr\Http\Message\RequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;


	$app = new \Slim\App();

	$app->add(function(Request $request, Response $response, $next){
		$response = $response->write("\nAntes da Rota 1");
		$response = $response->withHeader("Content-type","application/json");
		$next($request, $response);
		$response = $response->write("\nDepois da Rota 1");
		return $response;
	});

	
	/*$app->add(function(Request $request, Response $response, $next){
		$response = $response->write("\nAntes da Rota 2");
		$next($request, $response);
		$response = $response->write("\nDepois da Rota 2");
		return $response;
	});

	$app->add(function(Request $request, Response $response, $next){
		$response = $response->write("\nAntes da Rota 3");
		$next($request, $response);
		$response = $response->write("\nDepois da Rota 3");
		return $response;
	});*/



	$app->get("/", function(Request $request, Response $response){
		return $response->write("\nExemplo Rota!");
	});

	$app->run();

?>