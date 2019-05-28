<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/usuario", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "LISTAR_USUARIO");
        return $response->write(json_encode(\controller\UsuarioController::listar()));
    });

    $this->get("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "RECUPERAR_USUARIO");
        $usuario = \controller\UsuarioController::recuperar($args["id"]);

        if ($usuario) {
            return $response->write(json_encode($usuario));
        } else {
            throw new \model\MyException("Usuario não encontrado", 404);
        }
    });

    $this->post("", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "CRIAR_USUARIO");
        $json = json_decode($request->getBody());

        if (!is_object($json)) {
            throw new \model\MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new \model\MyException("Nome é obrigatório!", 400);
        }

        if (!property_exists($json, "usuario") || !$json->usuario) {
            throw new \model\MyException("Usuário é obrigatório!", 400);
        }

        if (!property_exists($json, "senha") || !$json->senha) {
            throw new \model\MyException("Senha é obrigatório!", 400);
        }

        if (!property_exists($json, "permissoes") || !is_array($json->permissoes)) {
            throw new \model\MyException("Permissões é obrigatório!", 400);
        }

        if ($usuario = \controller\UsuarioController::recuperarPorUsuario($json->usuario)) {
            throw new \model\MyException("Usuario já existe! Código: " . $usuario->idUsuario, 404);
        }

        $usuario = new \model\Usuario();
        $usuario->nome = $json->nome;
        $usuario->usuario = $json->usuario;
        $usuario->senha = md5($json->senha);        

        foreach ($json->permissoes as $permissao) {
            $usuario->permissoes[] = \controller\PermissaoController::recuperar($permissao->idPermissao);
        }

        $idUsuario = \controller\UsuarioController::criar($usuario);
        return $response->write(json_encode(\controller\UsuarioController::recuperar($idUsuario)));
    });

    $this->put("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "ALTERAR_USUARIO");
        $json = json_decode($request->getBody());
        $idUsuario = $args["id"];

        if (!is_object($json)) {
            throw new \model\MyException("Objeto inválido", 400);
        }

        if (!property_exists($json, "nome") || !$json->nome) {
            throw new \model\MyException("Nome é obrigatório!", 400);
        }

        if (!property_exists($json, "usuario") || !$json->usuario) {
            throw new \model\MyException("Usuário é obrigatório!", 400);
        }

        if (!property_exists($json, "senha") || !$json->senha) {
            throw new \model\MyException("Senha é obrigatório!", 400);
        }

        if (!property_exists($json, "permissoes") || !is_array($json->permissoes)) {
            throw new \model\MyException("Permissões é obrigatório!", 400);
        }

        if (!$usuario = \controller\UsuarioController::recuperar($idUsuario)) {
            throw new \model\MyException("Usuario não encontrado!", 404);
        }

        $usuario->nome = $json->nome;
        //$usuario->usuario = $json->usuario;
        $usuario->senha = md5($json->senha);
        $usuario->permissoes = [];

        foreach ($json->permissoes as $permissao) {
            $usuario->permissoes[] = \controller\PermissaoController::recuperar($permissao->idPermissao);
        }

        \controller\UsuarioController::alterar($usuario);
        return $response->write(json_encode(\controller\UsuarioController::recuperar($idUsuario)));
    });

    $this->delete("/{id:[0-9]+}", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "EXCLUIR_USUARIO");
        $idUsuario = $args["id"];

        if (!$usuario = \controller\UsuarioController::recuperar($idUsuario)) {
            throw new \model\MyException("Usuario não encontrado!", 404);
        }

        \controller\UsuarioController::excluir($usuario);
        return $response->write(json_encode($usuario));
    });
});
