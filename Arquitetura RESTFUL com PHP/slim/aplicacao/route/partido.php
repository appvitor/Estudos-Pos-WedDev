<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/partido", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        return $response->write(json_encode(PartidoController::listar()));
    });

    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $partido = PartidoController::recuperar($args["id"]);

        if ($partido) {
            return $response->write(json_encode($partido));
        } else {
            throw new MyException("Partido não encontrado", 404);
        }
    });

    $this->post("", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new MyException("Nome do partido é obrigatório!", 400);
        }

        if (!property_exists($json, "legenda") || !$json->legenda) {
            throw new MyException("Legenda é obrigatória!", 400);
        }

        $partido = new Partido();
        $partido->nome = $json->nome;
        $partido->legenda = $json->legenda;

        $idPartido = PartidoController::criar($partido);
        return $response->write(json_encode(PartidoController::recuperar($idPartido)));
    });

    $this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());
        $idPartido = $args["id"];

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new MyException("Nome do partido é obrigatório!", 400);
        }

        if (!property_exists($json, "legenda") || !$json->legenda) {
            throw new MyException("Legenda é obrigatória!", 400);
        }

        if (!$partido = PartidoController::recuperar($idPartido)) {
            throw new MyException("Partido não encontrado!", 404);
        }

        $partido->nome = $json->nome;
        $partido->legenda = $json->legenda;

        PartidoController::alterar($partido);
        return $response->write(json_encode(PartidoController::recuperar($idPartido)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $idPartido = $args["id"];

        if (!$partido = PartidoController::recuperar($idPartido)) {
            throw new MyException("Partido não encontrado!", 404);
        }

        PartidoController::excluir($partido);
        return $response->write(json_encode($partido));
    });
});

