<?php
	include_once('../../vendor/autoload.php');

	use Psr\Http\Message\RequestInterface as Request; //instancia de RequestInterface, feito com alias, apelidos
	use Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App();

	$app->group('/cliente', function(){

		$this->get('', function(Request $request, Response $response){
			//app, ao receber uma requisição HTTP GET de /cliente, faça isso:
			$cliente = new stdClass();
			$cliente->id = 10;
			$cliente->nome = 'Vitor';
			$cliente->cpf = '123.456.789-01';

			$clientes = array();
			$clientes[] = $cliente;

			$response = $response->write(json_encode($clientes));
			return $response;
		});

		$this->get('/{id:[0-9]+}', function(Request $request, Response $response, $args = []){
			//app, ao receber uma requisição HTTP GET de /cliente/idCliente, faça isso:
			$cliente = new stdClass();
			$cliente->id = $args['id'];
			$cliente->nome = 'Vitor ID';
			$cliente->cpf = '123.456.789-01';

			$response = $response->write(json_encode($cliente));
			return $response;
		});

		$this->post('', function(Request $request, Response $response){
			//app, ao receber uma requisição HTTP POST de /cliente, faça isso:
			$cliente = json_decode($request->getBody()); //pegue o conteudo que veio pelo JSON e coloque na variável

			return $response->write('Exemplo POST!')
							->write('Id: '.$cliente->id)
							->write('Nome:'.$cliente->nome)
							->write('Cpf: '.$cliente->cpf);
		});

		$this->put('/{id:[0-9]+}', function(Request $request, Response $response, $args = []){
			//app, ao receber uma requisição HTTP POST de /cliente, faça isso:
			$cliente = json_decode($request->getBody()); //pegue o conteudo que veio pelo JSON e coloque na variável

			return $response->write('Exemplo PUT!')
							->write('Id: '.$cliente->id)
							->write('Nome:'.$cliente->nome)
							->write('Cpf: '.$cliente->cpf);
		});


		$this->delete('/{id:[0-9]+}', function(Request $request, Response $response, $args = ['id']){
			//app, ao receber uma requisição HTTP DELETE de /cliente, faça isso:
			return $response->write('Exemplo DELETE: '.$args['id']);
		});
	});

	$app->run(); 
?>