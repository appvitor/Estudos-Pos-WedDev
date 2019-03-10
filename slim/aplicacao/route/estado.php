<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/estado", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        return $response->write(json_encode(EstadoController::listar()));
    });

    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $estado = EstadoController::recuperar($args["id"]);

        if ($estado) {
            return $response->write(json_encode($estado));
        } else {
            throw new MyException("Estado não encontrado", 404);
        }
    });

    $this->get("/{nome}", function(Request $request, Response $response, $args = []) use ($app) {
        $estado = EstadoController::recuperarPorNome($args["nome"]);

        if ($estado) {
            return $response->write(json_encode($estado));
        } else {
            throw new MyException("Estado não encontrado", 404);
        }
    });

    $this->get("/{sigla}", function(Request $request, Response $response, $args = []) use ($app) {
        $estado = EstadoController::recuperarPorSigla($args["sigla"]);

        if ($estado) {
            return $response->write(json_encode($estado));
        } else {
            throw new MyException("Estado não encontrado", 404);
        }
    });

    $this->post("", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new MyException("Nome do Estado é obrigatório!", 400);
        }

        if (!property_exists($json, "sigla") || !$json->sigla) {
            throw new MyException("Sigla é obrigatória!", 400);
        }

        $estado = new Estado();
        $estado->nome = $json->nome;
        $estado->sigla = $json->sigla;


        $idEstado = EstadoController::criar($estado);
        return $response->write(json_encode(EstadoController::recuperar($idEstado)));
    });

    $this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());
        $idEstado = $args["id"];

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new MyException("Nome é obrigatório!", 400);
        }

        if (!property_exists($json, "sigla") || !$json->sigla) {
            throw new MyException("Sigla é obrigatório!", 400);
        }

        if (!$estado = EstadoController::recuperar($idEstado)) {
            throw new MyException("Estado não encontrado!", 404);
        }

        $estado->nome = $json->nome;
        $estado->sigla = $json->sigla;

        EstadoController::alterar($estado);
        return $response->write(json_encode(EstadoController::recuperar($idEstado)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $idEstado = $args["id"];

        if (!$estado = EstadoController::recuperar($idEstado)) {
            throw new MyException("Estado não encontrado!", 404);
        }

        EstadoController::excluir($estado);
        return $response->write(json_encode($estado));
    });
});

