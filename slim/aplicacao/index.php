<?php

define("JWT_PASS", "webdev");

include_once("../../vendor/autoload.php");
include_once("./model/MyException.php");
include_once("./controller/Conexao.php");
include_once("./model/Bem.php");
include_once("./controller/BemController.php");
include_once("./model/Candidato.php");
include_once("./controller/CandidatoController.php");
include_once("./model/Cargo.php");
include_once("./controller/CargoController.php");
include_once("./model/Eleicao.php");
include_once("./controller/EleicaoController.php");
include_once("./model/Estado.php");
include_once("./controller/EstadoController.php");
include_once("./model/Partido.php");
include_once("./controller/PartidoController.php");
include_once("./model/Tipo.php");
include_once("./controller/TipoController.php");
include_once("./model/Usuario.php");
include_once("./controller/UsuarioController.php");


use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$container = new \Slim\Container();

$container["errorHandler"] = function($container) {

    return function(Request $request, Response $response, Exception $exception) use($container) {

        $erro = new stdClass;
        $erro->mensagem = $exception->getMessage();
        $erro->codigo = $exception->getCode();

        switch (get_class($exception)) {
            case "MyException":
                $erro->status = $exception->getCode();
                break;

            case "PDOException":
                $erro->status = 420;
                //$erro->mensagem = "Erro no banco de dados";
                break;

            default:
                $erro->status = 400;
                break;
        }

        return $container["response"]
                        ->withHeader("Content-type", "application/json")
                        ->withStatus($erro->status, $erro->mensagem)
                        ->write(json_encode($erro));
    };
};

$app = new \Slim\App($container);
$app->usuario = new Usuario();

$app->add(function(Request $request, Response $response, $next) use($app) {

    $rotasLiberadas = array("login");

   /* if (!in_array($request->getUri()->getPath(), $rotasLiberadas)) {

        if ($request->hasHeader("token")) {
            $token = $request->getHeaderLine("token");
            try {
                $jwt = \Firebase\JWT\JWT::decode($token, JWT_PASS, array("HS256"));
                $app->usuario->idUsuario = $jwt->id;
            } catch (Exception $e) {
                return $response->write("Token inválido")->withStatus(403, "Token inválido");
            }
        } else {
            return $response->write("Token não existe!")->withStatus(401, "Token não existe!");
        }
    }
*/
    $response = $response->withHeader("Content-type", "application/json");
    $response = $next($request, $response);
    return $response;
});

foreach (glob('route/*.php') as $filename) {
    include_once $filename;
}

$app->run();
