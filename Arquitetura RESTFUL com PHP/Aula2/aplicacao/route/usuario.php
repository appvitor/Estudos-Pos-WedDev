<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/usuario", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        PermissaoUtil::temPermissao($app->usuario, "LISTAR_USUARIO");
        return $response->write(json_encode(UsuarioController::listar()));
    });

    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        PermissaoUtil::temPermissao($app->usuario, "RECUPERAR_USUARIO");
        $usuario = UsuarioController::recuperar($args["id"]);

        if ($usuario) {
            return $response->write(json_encode($usuario));
        } else {
            throw new MyException("Usuario não encontrado", 404);
        }
    });

    $this->post("", function(Request $request, Response $response, $args = []) use ($app) {
        PermissaoUtil::temPermissao($app->usuario, "CRIAR_USUARIO");
        $json = json_decode($request->getBody());

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new MyException("Nome é obrigatório!", 400);
        }

        if (!property_exists($json, "usuario") || !$json->usuario) {
            throw new MyException("Usuário é obrigatório!", 400);
        }

        if (!property_exists($json, "senha") || !$json->senha) {
            throw new MyException("Senha é obrigatório!", 400);
        }

        if (!property_exists($json, "permissoes") || !is_array($json->permissoes)) {
            throw new MyException("Permissões é obrigatório!", 400);
        }

        if ($usuario = UsuarioController::recuperarPorUsuario($json->usuario)) {
            throw new MyException("Usuario já existe! Código: " . $usuario->idUsuario, 404);
        }

        $usuario = new Usuario();
        $usuario->nome = $json->nome;
        $usuario->usuario = $json->usuario;
        $usuario->senha = md5($json->senha);

        foreach ($json->permissoes as $permissao) {
            $usuario->permissoes[] = PermissaoController::recuperar($permissao->idPermissao);
        }

        $idUsuario = UsuarioController::criar($usuario);
        return $response->write(json_encode(UsuarioController::recuperar($idUsuario)));
    });

    $this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        PermissaoUtil::temPermissao($app->usuario, "ALTERAR_USUARIO");
        $json = json_decode($request->getBody());
        $idUsuario = $args["id"];

        if (!is_object($json)) {
            throw new MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new MyException("Nome é obrigatório!", 400);
        }

        if (!property_exists($json, "usuario") || !$json->usuario) {
            throw new MyException("Usuário é obrigatório!", 400);
        }

        if (!property_exists($json, "senha") || !$json->senha) {
            throw new MyException("Senha é obrigatório!", 400);
        }

        if (!property_exists($json, "permissoes") || !is_array($json->permissoes)) {
            throw new MyException("Permissões é obrigatório!", 400);
        }

        if (!$usuario = UsuarioController::recuperar($idUsuario)) {
            throw new MyException("Usuario não encontrado!", 404);
        }

        $usuario->nome = $json->nome;
        //$usuario->usuario = $json->usuario;
        $usuario->senha = md5($json->senha);

        foreach ($json->permissoes as $permissao) {
            $usuario->permissoes[] = PermissaoController::recuperar($permissao->idPermissao);
        }

        UsuarioController::alterar($usuario);
        return $response->write(json_encode(UsuarioController::recuperar($idUsuario)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        PermissaoUtil::temPermissao($app->usuario, "EXCLUIR_USUARIO");
        $idUsuario = $args["id"];

        if (!$usuario = UsuarioController::recuperar($idUsuario)) {
            throw new MyException("Usuario não encontrado!", 404);
        }

        UsuarioController::excluir($usuario);
        return $response->write(json_encode($usuario));
    });
});
