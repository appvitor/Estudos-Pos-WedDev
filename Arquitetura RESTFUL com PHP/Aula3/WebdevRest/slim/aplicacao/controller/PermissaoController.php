<?php

namespace controller;

class PermissaoController {

    public static function listar() {
        $sql = "SELECT idPermissao, descricao, chave 
                FROM permissao 
                ORDER BY descricao";

        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->execute();

        $permissaos = [];

        while ($permissaoBD = $sth->fetch(\PDO::FETCH_OBJ)) {
            $permissao = new \model\Permissao();
            $permissao->idPermissao = $permissaoBD->idPermissao;
            $permissao->descricao = $permissaoBD->descricao;
            $permissao->chave = $permissaoBD->chave;

            $permissaos[] = $permissao;
        }

        return $permissaos;
    }

    public static function listarPorUsuario(\model\Usuario $usuario) {
        $sql = "SELECT idPermissao, descricao, chave 
                FROM permissao as p
                WHERE EXISTS(SELECT 1 FROM usuario_permissao WHERE idUsuario=:idUsuario AND idPermissao=p.idPermissao)
                ORDER BY descricao";

        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idUsuario", $usuario->idUsuario, \PDO::PARAM_INT);
        $sth->execute();

        $permissaos = [];

        while ($permissaoBD = $sth->fetch(\PDO::FETCH_OBJ)) {
            $permissao = new \model\Permissao();
            $permissao->idPermissao = $permissaoBD->idPermissao;
            $permissao->descricao = $permissaoBD->descricao;
            $permissao->chave = $permissaoBD->chave;

            $permissaos[] = $permissao;
        }

        return $permissaos;
    }

    public static function recuperar($idPermissao) {
        $sql = "SELECT idPermissao, descricao, chave 
                FROM permissao 
                WHERE idPermissao=:idPermissao";

        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idPermissao", $idPermissao, \PDO::PARAM_INT);
        $sth->execute();

        if ($permissaoBD = $sth->fetch(\PDO::FETCH_OBJ)) {
            $permissao = new \model\Permissao();
            $permissao->idPermissao = $permissaoBD->idPermissao;
            $permissao->descricao = $permissaoBD->descricao;
            $permissao->chave = $permissaoBD->chave;
            return $permissao;
        }

        return false;
    }

    public static function temPermissao(\model\Usuario $usuario, $chave) {
        $sql = "SELECT p.idPermissao
                FROM permissao as p
                        INNER JOIN usuario_permissao as up ON p.idPermissao = up.idPermissao
                WHERE up.idUsuario = :idUsuario AND p.chave=:chave";

        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idUsuario", $usuario->idUsuario, \PDO::PARAM_INT);
        $sth->bindValue(":chave", $chave, \PDO::PARAM_STR);
        $sth->execute();

        return $sth->fetch(\PDO::FETCH_OBJ) ? true : false;
    }

    public static function criar(\model\Permissao $permissao) {
        $sql = "INSERT INTO permissao(descricao, chave) VALUES(:descricao, :chave)";
        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":descricao", $permissao->descricao, \PDO::PARAM_STR);
        $sth->bindValue(":chave", $permissao->chave, \PDO::PARAM_STR);
        $sth->execute();
        return \controller\Conexao::getConexao()->lastInsertId();
    }

    public static function alterar(\model\Permissao $permissao) {
        $sql = "UPDATE permissao SET descricao=:descricao, chave=:chave WHERE idPermissao=:idPermissao";
        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idPermissao", $permissao->idPermissao, \PDO::PARAM_INT);
        $sth->bindValue(":descricao", $permissao->descricao, \PDO::PARAM_STR);
        $sth->bindValue(":chave", $permissao->chave, \PDO::PARAM_STR);
        $sth->execute();
    }

    public static function excluir(\model\Permissao $permissao) {
        $sql = "DELETE FROM permissao WHERE idPermissao=:idPermissao";
        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idPermissao", $permissao->idPermissao, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->rowCount() == 1;
    }

}