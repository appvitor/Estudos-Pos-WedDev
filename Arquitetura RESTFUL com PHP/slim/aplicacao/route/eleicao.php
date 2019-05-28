<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/eleicao", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        return $response->write(json_encode(EleicaoController::listar()));
    });


    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $eleicao = EleicaoController::recuperar($args["id"]);

        if ($eleicao) {
            return $response->write(json_encode($eleicao));
        } else {
            throw new MyException("Eleição não encontrada", 404);
        }
    });

    $this->get("/{nome}", function(Request $request, Response $response, $args = []) use ($app) {
        $eleicao = EleicaoController::recuperarPorNome($args["nome"]);

        if ($eleicao) {
            return $response->write(json_encode($eleicao));
        } else {
            throw new MyException("Eleição não encontrada", 404);
        }
    });

    $this->get("/{ano:[0-9]+4}", function(Request $request, Response $response, $args = []) use ($app) {
        $eleicao = EleicaoController::recuperarPorAno($args["ano"]);

        if ($eleicao) {
            return $response->write(json_encode($eleicao));
        } else {
            throw new MyException("Eleição não encontrada", 404);
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

        if (!property_exists($json, "ano") || !$json->ano) {
            throw new MyException("Ano é obrigatório!", 400);
        }

        $eleicao = new Eleicao();
        $eleicao->nome = $json->nome;
        $eleicao->ano = $json->ano;

        $idCandidato = EleicaoController::criar($eleicao);
        return $response->write(json_encode(EleicaoController::recuperar($idCandidato)));
    });

    $this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $json = json_decode($request->getBody());
        $idEleicao = $args["id"];

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new MyException("Nome é obrigatório!", 400);
        }

        if (!property_exists($json, "ano") || !$json->ano) {
            throw new MyException("Ano é obrigatório!", 400);
        }

        if (!$eleicao = EleicaoController::recuperar($idCandidato)) {
            throw new MyException("Eleição não encontrada!", 404);
        }

        $eleicao->nome = $json->nome;
        $eleicao->ano = $json->ano;

        EleicaoController::alterar($eleicao);
        return $response->write(json_encode(EleicaoController::recuperar($idCandidato)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        $idEleicao = $args["id"];

        if (!$eleicao = EleicaoController::recuperar($idCandidato)) {
            throw new MyException("Eleição não encontrada!", 404);
        }

        EleicaoController::excluir($eleicao);
        return $response->write(json_encode($eleicao));
    });
});

