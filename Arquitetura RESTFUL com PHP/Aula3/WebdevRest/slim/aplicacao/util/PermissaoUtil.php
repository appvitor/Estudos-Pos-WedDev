<?php

namespace util;

class PermissaoUtil {

    public static function temPermissao(\model\Usuario $usuario, $chave) {
        if (!\controller\PermissaoController::temPermissao($usuario, $chave)) {
            throw new \model\MyException("Permissão negada para a chave '{$chave}'!", 403);
        }
    }

}
