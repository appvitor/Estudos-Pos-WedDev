<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/bem", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        return $response->write(json_encode(BemController::listar()));
    });

    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $bem = BemController::recuperar($args["id"]);

        if ($bem) {
            return $response->write(json_encode($bem));
        } else {
            throw new MyException("Bem não encontrado", 404);
        }
    });

    $this->post("", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "descricao") || !$json->descricao) {
            throw new MyException("Descrição é obrigatório!", 400);
        }

        if (!property_exists($json, "valor") || !$json->valor) {
            throw new MyException("Valor é obrigatório!", 400);
        }

        $bem = new Bem();
        $bem->descricao = $json->descricao;
        $bem->valor = $json->valor;

        $idBem = BemController::criar($bem);
        return $response->write(json_encode(BemController::recuperar($idBem)));
    });

    $this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());
        $idBem = $args["id"];

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "descricao") || !$json->descricao) {
            throw new MyException("Descrição é obrigatório!", 400);
        }

        if (!property_exists($json, "valor") || !$json->valor) {
            throw new MyException("Valor é obrigatório!", 400);
        }

        if (!$bem = BemController::recuperar($idBem)) {
            throw new MyException("Bem não encontrado!", 404);
        }

        $bem->descricao = $json->descricao;
        $bem->valor = $json->valor;

        BemController::alterar($bem);
        return $response->write(json_encode(BemController::recuperar($idBem)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $idBem = $args["id"];

        if (!$bem = BemController::recuperar($idBem)) {
            throw new MyException("Bem não encontrado!", 404);
        }

        BemController::excluir($bem);
        return $response->write(json_encode($bem));
    });
});

