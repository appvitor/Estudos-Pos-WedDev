<?php

	define("JWT_PASS", "webdev");

	include_once("../../vendor/autoload.php");

	use Psr\Http\Message\RequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;


	$app = new \Slim\App();


	$app->add(function(Request $request, Response $response, $next){


		$rotasLiberadas = array("login");

		if(!in_array($request->getUri()->getPath(), $rotasLiberadas)){		

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
	
		$response = $response->withHeader("Content-type","application/json");
		$next($request, $response);
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
		return $response->write("Rota Cliente");
	});

	$app->get("/produto", function(Request $request, Response $response){		
		return $response->write("Rota Produto");
	});

	$app->run();

?>