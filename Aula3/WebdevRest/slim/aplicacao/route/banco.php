<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/banco", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "LISTAR_BANCO");
        return $response->write(json_encode(\controller\BancoController::listar()));
    });

    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "RECUPERAR_BANCO");
        $banco = \controller\BancoController::recuperar($args["id"]);

        if ($banco) {
            return $response->write(json_encode($banco));
        } else {
            throw new \model\MyException("Banco não encontrado", 404);
        }
    });

    $this->post("", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "CRIAR_BANCO");
        $json = json_decode($request->getBody());

        if (!is_object($json)) {
            throw new \model\MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new \model\MyException("Nome do banco é obrigatório!", 400);
        }

        $banco = new \model\banco();
        $banco->nome = $json->nome;

        $idBanco = \controller\BancoController::criar($banco);
        return $response->write(json_encode(\controller\BancoController::recuperar($idBanco)));
    });

    $this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "ALTERAR_BANCO");
        $json = json_decode($request->getBody());
        $idBanco = $args["id"];

        if (!is_object($json)) {
            throw new \model\MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new \model\MyException("Nome do banco é obrigatório!", 400);
        }

        if (!$banco = \controller\BancoController::recuperar($idBanco)) {
            throw new \model\MyException("Banco não encontrado!", 404);
        }

        $banco->nome = $json->nome;

        \controller\BancoController::alterar($banco);
        return $response->write(json_encode(\controller\BancoController::recuperar($idBanco)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "EXCLUIR_BANCO");
        $idBanco = $args["id"];

        if (!$banco = \controller\BancoController::recuperar($idBanco)) {
            throw new \model\MyException("Banco não encontrado!", 404);
        }

        \controller\BancoController::excluir($banco);
        return $response->write(json_encode($banco));
    });
});

