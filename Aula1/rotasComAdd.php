<?php
	include_once('../../vendor/autoload.php');

	use Psr\Http\Message\RequestInterface as Request; //instancia de RequestInterface, feito com alias, apelidos
	use Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App();

	$app->add(function(Request $request, Response $response, $next){ //a funcao add é executada ANTES de qualquer código, e o seu parametro $next é quem chama a sequencia d código a ser executado

		$response = $response->write("\nAntes da Rota 1");
		$response = $response->withHeader('Content-Type', 'application/json'); //especificando no cabeçalho o tipo de conteudo da aplicação

		$next($request, $response);
		$response = $response->write("\nDepois da Rota 1");
		return $response;
	});

	$app->get('/', function(Request $request, Response $response){

		return $response->write("\nExemplo Rota!");
	});

	$app->run(); 
?>