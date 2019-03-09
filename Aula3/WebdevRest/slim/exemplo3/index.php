<?php

	include_once("../../vendor/autoload.php");

	use Psr\Http\Message\RequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;


	$app = new \Slim\App();

	$app->get("/", function(Request $request, Response $response){

		if($request->hasHeader("token")){
			$token = $request->getHeaderLine("token");

			if($token == "123456"){
				return $response->write("Token válido")->withStatus(200, "Token válido");
			}else{
				return $response->write("Token inválido")->withStatus(403,"Token inválido");
			}
			
		}else{
			return $response->write("Token não existe!")->withStatus(401, "Token não existe!");
		}
		
	});

	$app->run();

?>