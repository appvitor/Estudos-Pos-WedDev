<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->post("/login", function(Request $request, Response $response) {
    $json = json_decode($request->getBody());

    if (!is_object($json)) {
        throw new \model\MyException("Objeto inválido", 400);
    }

    if (!property_exists($json, "usuario") || !$json->usuario) {
        throw new \model\MyException("Usuário é obrigatório!", 400);
    }

    if (!property_exists($json, "senha") || !$json->senha) {
        throw new \model\MyException("Senha é obrigatório!", 400);
    }

    if (!$usuario = \controller\UsuarioController::recuperarPorUsuarioSenha($json->usuario, $json->senha)) {
        throw new \model\MyException("Usuário ou Senha incorreto!", 403);
    }

    \util\PermissaoUtil::temPermissao($usuario, "REALIZAR_LOGIN");

    $jwt = new stdClass();
    $jwt->id = $usuario->idUsuario;
    $jwt->exp = time() + (60 * 60);

    $token = \Firebase\JWT\JWT::encode($jwt, JWT_PASS);
    
    $retorno = new stdClass;
    $retorno->token = $token;
    
    return $response->write(json_encode($retorno));
});
