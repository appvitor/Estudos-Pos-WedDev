<?php
	include_once('../../vendor/autoload.php');

	use Psr\Http\Message\RequestInterface as Request; //instancia de RequestInterface, feito com alias, apelidos
	use Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App();

	$app->get('/+/{num1:[0-9]+}/{num2:[0-9]+}', function(Request $request, Response $response, $args){

		$resultado = $args['num1']+$args['num2'];
		$response->write($resultado);
		return $response;
	});

	$app->get('/-/{num1:[0-9]+}/{num2:[0-9]+}', function(Request $request, Response $response, $args){

		$resultado = $args['num1']-$args['num2'];
		$response->write($resultado);
		return $response;
	});

	$app->get('/m/{num1:[0-9]+}/{num2:[0-9]+}', function(Request $request, Response $response, $args){

		$resultado = $args['num1']*$args['num2'];
		$response->write($resultado);
		return $response;
	});

	$app->get('/d/{num1:[0-9]+}/{num2:[0-9]+}', function(Request $request, Response $response, $args){
		
		$resultado = $args['num1']/$args['num2'];
		$response->write($resultado);
		return $response;;
	});
/*
	$app->post('', function(Request $request, Response $response){

		return $response;
	});

	$app->post("/calc", function(Request $request, Response $response, $args){

		$operacao = json_decode($request->getBody());
		
		if(!is_numeric($operacao->numero1) || !is_numeric($operacao->numero2)){
			return $response->withStatus(404);
		}

		switch($operacao->$operador) {
			case 1:
				$resultado = $operacao->numero1 + $operacao->numero2;
			break;
			case 2:
				$resultado = $operacao->numero1 - $operacao->numero2;
			break;
			case 3:
				$resultado = $operacao->numero1 * $operacao->numero2;
			break;
			case 4:
				$resultado = $operacao->numero1 / $operacao->numero2;
			break;
			default:
				return $response->withStatus(404);
			break;
			return $response->write($resultado);
		}
	});
*/
	$app->run(); 
?>