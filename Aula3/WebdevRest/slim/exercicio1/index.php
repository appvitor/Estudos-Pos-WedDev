<?php

	include_once("../../vendor/autoload.php");

	use Psr\Http\Message\RequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;

	$container = new \Slim\Container();

	$container["errorHandler"] = function($container){

		return function(Request $request, Response $response, Exception $exception) use($container){

			$erro = new stdClass;
			$erro->mensagem = $exception->getMessage();
			$erro->codigo = $exception->getCode();

			return $container["response"]
						->withHeader("Content-type","application/json")
						->withStatus($exception->getCode(), $exception->getMessage())
						->write(json_encode($erro));

		};

	};

	$app = new \Slim\App($container);

	$app->add(function(Request $request, Response $response, $next){
		$response = $response->withHeader("Content-type","application/json");
		$next($request, $response);
		return $response;
	});

	$app->post("/calculadora", function(Request $request, Response $response, $args = []){

		$operacao = json_decode($request->getBody());

		if(!is_object($operacao)){			
			throw new Exception("Dados inválidos!", 400);
		}

		if(!property_exists($operacao, "numero1") || !is_numeric($operacao->numero1)){
			throw new Exception("Número 1 inválido!",400);
		}

		if(!property_exists($operacao, "numero2") || !is_numeric($operacao->numero2)){
			throw new Exception("Número 2 inválido!",400);
		}

		if(!property_exists($operacao, "operador")){
			throw new Exception("Operador inválido!",400);
		}

		switch ($operacao->operador) {
			case 1: //soma
				$resultado=$operacao->numero1 + $operacao->numero2;
				break;

			case 2: //subtração
				$resultado=$operacao->numero1 - $operacao->numero2;
				break;	

			case 3: //multiplicação
				$resultado=$operacao->numero1 * $operacao->numero2;
				break;	

			case 4: //divisão
				if($operacao->numero2 == 0){
					throw new Exception("Divisão por zero!",400);
				}

				$resultado=$operacao->numero1 / $operacao->numero2;
				break;

			default:	
				throw new Exception("Operação não encontrada!",404);
		}



		return $response->write($resultado);
	});

	$app->get("/soma/{n1:[0-9]+}/{n2:[0-9]+}", function(Request $request, Response $response, $args = []){
		$resultado = $args["n1"] + $args["n2"];
		return $response->write($resultado);
	});

	$app->get("/subtracao/{n1:[0-9]+}/{n2:[0-9]+}", function(Request $request, Response $response, $args = []){
		$resultado = $args["n1"] - $args["n2"];
		return $response->write($resultado);
	});

	$app->get("/multiplicacao/{n1:[0-9]+}/{n2:[0-9]+}", function(Request $request, Response $response, $args = []){
		$resultado = $args["n1"] * $args["n2"];
		return $response->write($resultado);
	});

	$app->get("/divisao/{n1:[0-9]+}/{n2:[0-9]+}", function(Request $request, Response $response, $args = []){
		$resultado = $args["n1"] / $args["n2"];
		return $response->write($resultado);
	});

	$app->run();

?>