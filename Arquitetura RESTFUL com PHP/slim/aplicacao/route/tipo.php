<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/bem", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        return $response->write(json_encode(TipoController::listar()));
    });

    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $tipo = TipoController::recuperar($args["id"]);

        if ($tipo) {
            return $response->write(json_encode($tipo));
        } else {
            throw new MyException("Tipo não encontrado", 404);
        }
    });

    $this->get("/{nome}", function(Request $request, Response $response, $args = []) use ($app) {
        $tipo = TipoController::recuperarPorNome($args["nome"]);

        if ($tipo) {
            return $response->write(json_encode($tipo));
        } else {
            throw new MyException("Tipo não encontrado", 404);
        }
    });

    $this->post("", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->descricao) {
            throw new MyException("Nome do tipo é obrigatório!", 400);
        }

        $tipo = new Tipo();
        $tipo->nome = $json->nome;

        $idBem = TipoController::criar($tipo);
        return $response->write(json_encode(TipoController::recuperar($idBem)));
    });

    $this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());
        $idBem = $args["id"];

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->descricao) {
            throw new MyException("Nome do tipo é obrigatório!", 400);
        }

        if (!$tipo = TipoController::recuperar($idBem)) {
            throw new MyException("Tipo não encontrado!", 404);
        }

        $tipo->nome = $json->nome;

        TipoController::alterar($tipo);
        return $response->write(json_encode(TipoController::recuperar($idBem)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $idBem = $args["id"];

        if (!$tipo = TipoController::recuperar($idBem)) {
            throw new MyException("Tipo não encontrado!", 404);
        }

        TipoController::excluir($tipo);
        return $response->write(json_encode($tipo));
    });
});

