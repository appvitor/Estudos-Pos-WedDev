<?php

	include_once("../../vendor/autoload.php");

	use Psr\Http\Message\RequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;


	$app = new \Slim\App();

	$app->group("/cliente", function(){
		$this->get("", function(Request $request, Response $response){
		
			$cliente = new stdClass();
			$cliente->id = 10;
			$cliente->nome = "Luiz Henrique";
			$cliente->cpf = "999.999.999-99";

			$clientes = array();
			$clientes[] = $cliente;

			$response = $response->write(json_encode($clientes));
			return $response;
		});

		$this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []){
			
			$cliente = new stdClass();
			$cliente->id = $args["id"];
			$cliente->nome = "Luiz Henrique";
			$cliente->cpf = "999.999.999-99";
			
			$response = $response->write(json_encode($cliente));
			return $response;
		});

		$this->post("", function(Request $request, Response $response){

			$cliente = json_decode($request->getBody());

			return $response
						->write("Exemplo POST!")
						->write("\nId: " . $cliente->id)
						->write("\nNome: " . $cliente->nome)
						->write("\nCpf: " . $cliente->cpf);
		});


		$this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []){

			$cliente = json_decode($request->getBody());

			return $response
						->write("Exemplo PUT!: " . $args["id"])
						->write("\nId: " . $args["id"])
						->write("\nNome: " . $cliente->nome)
						->write("\nCpf: " . $cliente->cpf);
		});

		$this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []){
			return $response->write("Exemplo DELETE!: " . $args["id"]);
		});
	});

	$app->run();

?>