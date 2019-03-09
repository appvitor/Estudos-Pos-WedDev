<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/cargo", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        return $response->write(json_encode(CandidatoController::listar()));
    });

    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $candidato = CandidatoController::recuperar($args["id"]);

        if ($candidato) {
            return $response->write(json_encode($candidato));
        } else {
            throw new MyException("Candidato não encontrado", 404);
        }
    });

    $this->post("", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new MyException("Nome é obrigatório!", 400);
        }

        if (!property_exists($json, "cpf") || !$json->cpf) {
            throw new MyException("CPF é obrigatório!", 400);
        }

        if (!property_exists($json, "apto") || !$json->apto) {
            throw new MyException("Apto é obrigatório!", 400);
        }

        $candidato = new Candidato();
        $candidato->nome = $json->nome;
        $candidato->cpf = $json->cpf;
        $candidato->apto = $json->apto;

        $idCandidato = CandidatoController::criar($candidato);
        return $response->write(json_encode(CandidatoController::recuperar($idCandidato)));
    });

    $this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());
        $idCandidato = $args["id"];

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new MyException("Nome é obrigatório!", 400);
        }

        if (!property_exists($json, "cpf") || !$json->cpf) {
            throw new MyException("CPF é obrigatório!", 400);
        }

        if (!property_exists($json, "apto") || !$json->cpf) {
            throw new MyException("Apto é obrigatório!", 400);
        }

        if (!$candidato = CandidatoController::recuperar($idCandidato)) {
            throw new MyException("Candidato não encontrado!", 404);
        }

        $candidato->nome = $json->nome;
        $candidato->cpf = $json->cpf;
        $candidato->apto = $json->apto;

        CandidatoController::alterar($candidato);
        return $response->write(json_encode(CandidatoController::recuperar($idCandidato)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $idCandidato = $args["id"];

        if (!$candidato = CandidatoController::recuperar($idCandidato)) {
            throw new MyException("Candidato não encontrado!", 404);
        }

        CandidatoController::excluir($candidato);
        return $response->write(json_encode($candidato));
    });
});

