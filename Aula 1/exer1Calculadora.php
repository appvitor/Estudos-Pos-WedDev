<?php
	include_once('../../vendor/autoload.php');

	use Psr\Http\Message\RequestInterface as Request; //instancia de RequestInterface, feito com alias, apelidos
	use Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App();

	$app->get('/+/{num1:[0-9]+/num2:[0-9]+}', function(Request $request, Response $response){

		$response->write("$args['num1'] + $args['num2'] = ".$args['num1'] + $args['num2']);
		return $response;
	});
/*
	$app->get('/-', function(Request $request, Response $response){

		return $response;
	});

	$app->get('/*', function(Request $request, Response $response){

		return $response;
	});

	$app->get('/d', function(Request $request, Response $response){

		return $response;
	});

	$app->post('', function(Request $request, Response $response){

		return $response;
	});
*/
	$app->run(); 
?>