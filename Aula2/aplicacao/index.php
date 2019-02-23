<?php

	define("JWT_PASS", "webdev");

	include_once("../../vendor/autoload.php");
	include_once("./MyException.php");

	include_once("./Conexao.php");
	include_once("./Cliente.php");
	include_once("./ClienteController.php");

	use Psr\Http\Message\RequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;

	$container = new \Slim\Container();

	$container["errorHandler"] = function($container){

		return function(Request $request, Response $response, Exception $exception) use($container){

			$erro = new stdClass;
			$erro->mensagem = $exception->getMessage();
			$erro->codigo = $exception->getCode();

			switch (get_class($exception)){

				case "MyException":
					$erro->status = $exception->getCode();
				break;

				case "PDOException":
					$erro->status = 420;
					$erro->mensagem = 'Erro no banco de dados';
				break;

				default:
					$erro->status = 400;
				break;
			}

			return $container["response"]
						->withHeader("Content-type","application/json")
						->withStatus($erro->status, $erro->mensagem)
						->write(json_encode($erro));

		};

	};

	$app = new \Slim\App($container);


	$app->add(function(Request $request, Response $response, $next){


		$rotasLiberadas = array("login");

/*		if(!in_array($request->getUri()->getPath(), $rotasLiberadas)){		

			if($request->hasHeader("token")){
				$token = $request->getHeaderLine("token");
				try{
					$jwt = \Firebase\JWT\JWT::decode($token, JWT_PASS, array("HS256"));			
				}catch(Exception $e){
					return $response->write("Token inválido")->withStatus(403,"Token inválido");
				}			
			}else{
				return $response->write("Token não existe!")->withStatus(401, "Token não existe!");
			}
		}
*/	
		$response = $response->withHeader("Content-type","application/json");
		$response = $next($request, $response);
		return $response;
	});


	$app->get("/login", function(Request $request, Response $response){		
		$jwt = new stdClass();
		$jwt->id 	= 10;
		$jwt->nome 	= "Luiz";
		$jwt->exp 	= time() + 60;

		$token = \Firebase\JWT\JWT::encode($jwt, JWT_PASS);
		return $response->write($token);

	});

	$app->get("/cliente", function(Request $request, Response $response){
		
		return $response->write(json_encode(ClienteController::listar()));
	});

	$app->get("/cliente/{id:[0-9]+}", function(Request $request, Response $response, $args = []){
		
		$cliente = ClienteController::recuperar($args['id']); //chame a função recuperar da classe Cliente Controller

		if($cliente){
			return $response->write(json_encode($cliente));
		}
		else {
			throw new MyException("Cliente não encontrado", 404);
		}
	});

	$app->post("/cliente", function(Request $request, Response $response, $args = []){
		
		$json = json_decode($request->getBody());

		if(!is_object($json)){
			throw new MyException("Objeto inválido!", 400);
		}

		if(!property_exists($json, 'nome') || !$json->nome){ //verificar se a propriedade não existe ou se ela não está vazia
			throw new Exception("Nome é obrigatório", 400);
		}


		if(!property_exists($json, 'cpf') || !$json->cpf){
			throw new Exception("CPF é obrigatório", 400);
		}

		$cliente = new Cliente();
		$cliente->nome = $json->nome;
		$cliente->cpf = $json->cpf;

		$idCliente = ClienteController::criar($cliente);
		return $response->write(json_encode(ClienteController::recuperar($idCliente)));
	});

	$app->put("/cliente/{id: [0-9]+}", function(Request $request, Response $response, $args = []){
		
		$json = json_decode($request->getBody());
		$idCliente = args["id"];

		if(!is_object($json)){
			throw new MyException("Objeto inválido!", 400);
		}

		if(!property_exists($json, 'nome') || !$json->nome){ //verificar se a propriedade não existe ou se ela não está vazia
			throw new MyException("Nome é obrigatório", 400);
		}


		if(!property_exists($json, 'cpf') || !$json->cpf){
			throw new MyException("CPF é obrigatório", 400);
		}

		if(!ClienteController::recuperar($args['id'])) {
			throw new MyException("Cliente não encontrado!", 404);
			
		}

		$cliente = new Cliente();
		$cliente->idCliente = $args["id"];
		$cliente->nome = $json->nome;
		$cliente->cpf = $json->cpf;

		ClienteController::alterar($cliente);
		return $response->write(json_encode(ClienteController::recuperar($args["id"])));		
	});

	$app->delete("/cliente/{id: [0-9]+}", function(Request $request, Response $response, $args = []){

		$idCliente = $args["id"];

		if(!$cliente = ClienteController::recuperar($idCliente)){
			throw new MyException("Cliente não encontrado", 404);
		}

		ClienteController::excluir($cliente); //Chamada no controler da função excluir, passando o cliente a ser excluido
		return $response;->write(json_encode($cliente)); //exibir o cliente excluido
	});

	$app->run();

?>