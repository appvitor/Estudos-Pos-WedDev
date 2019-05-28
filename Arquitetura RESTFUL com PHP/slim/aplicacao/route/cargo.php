<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/cargo", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        return $response->write(json_encode(CargoController::listar()));
    });

    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $cargo = CargoController::recuperar($args["id"]);

        if ($cargo) {
            return $response->write(json_encode($cargo));
        } else {
            throw new MyException("Cargo não encontrado", 404);
        }
    });

    $this->post("", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new MyException("Nome do cargo é obrigatório!", 400);
        }

        $cargo = new Partido();
        $cargo->nome = $json->nome;
        
        $idCargo = CargoController::criar($cargo);
        return $response->write(json_encode(CargoController::recuperar($idCargo)));
    });

    $this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());
        $idCargo = $args["id"];

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new MyException("Nome do cargo é obrigatório!", 400);
        }

        if (!$cargo = CargoController::recuperar($idCargo)) {
            throw new MyException("Cargo não encontrado!", 404);
        }

        $cargo->nome = $json->nome;

        CargoController::alterar($cargo);
        return $response->write(json_encode(CargoController::recuperar($idCargo)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $idCargo = $args["id"];

        if (!$cargo = CargoController::recuperar($idCargo)) {
            throw new MyException("Cargo não encontrado!", 404);
        }

        CargoController::excluir($cargo);
        return $response->write(json_encode($cargo));
    });
});

