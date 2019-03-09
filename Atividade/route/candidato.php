<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/candidato", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        return $response->write(json_encode(CandidatoController::listar()));
    });

    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $candidato = CandidatoController::recuperar($args["id"]);

        if ($candidato) {
            return $response->write(json_encode($candidato));
        } else {
            throw new MyException("Cliente não encontrado", 404);
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

        $candidato = new Cliente();
        $candidato->nome = $json->nome;
        $candidato->cpf = $json->cpf;

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

        if (!$candidato = CandidatoController::recuperar($idCandidato)) {
            throw new MyException("Cliente não encontrado!", 404);
        }

        $candidato->nome = $json->nome;
        $candidato->cpf = $json->cpf;

        CandidatoController::alterar($candidato);
        return $response->write(json_encode(CandidatoController::recuperar($idCandidato)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        PermissaoUtil::temPermissao($app->usuario, "EXCLUIR_CLIENTE");
        $idCandidato = $args["id"];

        if (!$candidato = CandidatoController::recuperar($idCandidato)) {
            throw new MyException("Cliente não encontrado!", 404);
        }

        CandidatoController::excluir($candidato);
        return $response->write(json_encode($candidato));
    });
});

