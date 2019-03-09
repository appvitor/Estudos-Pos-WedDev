<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/cliente", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "LISTAR_CLIENTE");
        return $response->write(json_encode(\controller\ClienteController::listar()));
    });

    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "RECUPERAR_CLIENTE");
        $cliente = \controller\ClienteController::recuperar($args["id"]);

        if ($cliente) {
            return $response->write(json_encode($cliente));
        } else {
            throw new \model\MyException("Cliente não encontrado", 404);
        }
    });

    $this->post("", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "CRIAR_CLIENTE");
        $json = json_decode($request->getBody());

        if (!is_object($json)) {
            throw new \model\MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new \model\MyException("Nome é obrigatório!", 400);
        }

        if (!property_exists($json, "cpf") || !$json->cpf) {
            throw new \model\MyException("CPF é obrigatório!", 400);
        }

        $cliente = new \model\Cliente();
        $cliente->nome = $json->nome;
        $cliente->cpf = $json->cpf;

        $idCliente = \controller\ClienteController::criar($cliente);
        return $response->write(json_encode(\controller\ClienteController::recuperar($idCliente)));
    });

    $this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "ALTERAR_CLIENTE");
        $json = json_decode($request->getBody());
        $idCliente = $args["id"];

        if (!is_object($json)) {
            throw new \model\MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new \model\MyException("Nome é obrigatório!", 400);
        }

        if (!property_exists($json, "cpf") || !$json->cpf) {
            throw new \model\MyException("CPF é obrigatório!", 400);
        }

        if (!$cliente = \controller\ClienteController::recuperar($idCliente)) {
            throw new \model\MyException("Cliente não encontrado!", 404);
        }

        $cliente->nome = $json->nome;
        $cliente->cpf = $json->cpf;

        \controller\ClienteController::alterar($cliente);
        return $response->write(json_encode(\controller\ClienteController::recuperar($idCliente)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "EXCLUIR_CLIENTE");
        $idCliente = $args["id"];

        if (!$cliente = \controller\ClienteController::recuperar($idCliente)) {
            throw new \model\MyException("Cliente não encontrado!", 404);
        }

        \controller\ClienteController::excluir($cliente);
        return $response->write(json_encode($cliente));
    });
});

