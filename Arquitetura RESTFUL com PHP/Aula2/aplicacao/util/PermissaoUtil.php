<?php

class PermissaoUtil {

    public static function temPermissao(Usuario $usuario, $chave) {
        if (!PermissaoController::temPermissao($usuario, $chave)) {
            throw new MyException("Permissão negada para a chave '{$chave}'!", 403);
        }
    }

}
