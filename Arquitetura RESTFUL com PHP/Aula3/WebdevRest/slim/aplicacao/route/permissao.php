<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->group("/permissao", function() use ($app) {

    $this->get("", function(Request $request, Response $response, $args = []) use ($app) {
        \util\PermissaoUtil::temPermissao($app->usuario, "LISTAR_PERMISSAO");
        return $response->write(json_encode(\controller\PermissaoController::listar()));
    });
});

