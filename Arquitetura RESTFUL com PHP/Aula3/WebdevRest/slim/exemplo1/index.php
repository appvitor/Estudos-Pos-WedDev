<?php

	include_once("../../vendor/autoload.php");

	use Psr\Http\Message\RequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;


	$app = new \Slim\App();

	$app->add(function(Request $request, Response $response, $next){
		$response = $response->withHeader("Content-type","application/json");
		$next($request, $response);
		return $response;
	});

	$app->get("/", function(Request $request, Response $response){
		return $response->write("Exemplo Get no / ");
	});

	$app->get("/cliente", function(Request $request, Response $response){
		
		$cliente = new stdClass();
		$cliente->id = 10;
		$cliente->nome = "Luiz Henrique";
		$cliente->cpf = "999.999.999-99";

		$clientes = array();
		$clientes[] = $cliente;

		$response = $response->write(json_encode($clientes));
		return $response;
	});

	$app->get("/cliente/{id:[0-9]+}", function(Request $request, Response $response, $args = []){
		
		$cliente = new stdClass();
		$cliente->id = $args["id"];
		$cliente->nome = "Luiz Henrique";
		$cliente->cpf = "999.999.999-99";
		
		$response = $response->write(json_encode($cliente));
		return $response;
	});

	$app->post("/cliente", function(Request $request, Response $response){

		$cliente = json_decode($request->getBody());

		return $response
					->write("Exemplo POST!")
					->write("\nId: " . $cliente->id)
					->write("\nNome: " . $cliente->nome)
					->write("\nCpf: " . $cliente->cpf);

	});


	$app->put("/cliente/{id:[0-9]+}", function(Request $request, Response $response, $args = []){

		$cliente = json_decode($request->getBody());

		return $response
					->write("Exemplo PUT!: " . $args["id"])
					->write("\nId: " . $args["id"])
					->write("\nNome: " . $cliente->nome)
					->write("\nCpf: " . $cliente->cpf);

	});

	$app->delete("/cliente/{id:[0-9]+}", function(Request $request, Response $response, $args = []){
		return $response->write("Exemplo DELETE!: " . $args["id"]);

	});

	//parametro opcional
	$app->get("/teste/[{id}]", function(Request $request, Response $response, $args = []){
		return $response->write("Exemplo Get no / " . (isset($args["id"]) ? $args["id"] : ""));
	});

	$app->run();

?>