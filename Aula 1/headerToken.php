<?php
	include_once('../../vendor/autoload.php');

	use Psr\Http\Message\RequestInterface as Request; //instancia de RequestInterface, feito com alias, apelidos
	use Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App();

	$app->get('/', function(Request $request, Response $response){
	
		if($request->hasHeader('token')){ //verificando se o cabeçalho (header) possui uma variavel chamada token
			$token = $request->getHeaderLine('token');

			if($token == '123456'){
				return $response->write('Token válido')->withStatus(200);
			}
			else{
				return $response->write('token inválido!')->withStatus(403);
			}

			return $response->write('Token existe');
		}
		else {
			return $response->write('Token inexistente!')->withStatus(401);
		}
	});

	$app->run(); 
?>