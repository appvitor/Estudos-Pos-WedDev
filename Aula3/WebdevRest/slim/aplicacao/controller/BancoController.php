<?php

namespace controller;

class BancoController {

    public static function listar() {

        $sql = "SELECT idBanco, nome 
					FROM banco 
					ORDER BY nome";

        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->execute();

        $bancos = [];

        while ($bancoBD = $sth->fetch(\PDO::FETCH_OBJ)) {
            $banco = new \model\banco();
            $banco->idBanco = $bancoBD->idBanco;
            $banco->nome = $bancoBD->nome;
            $bancos[] = $banco;
        }

        return $bancos;
    }

    public static function recuperar($idBanco) {

        $sql = "SELECT idBanco, nome 
                FROM banco 
                WHERE idBanco=:idBanco";

        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idBanco", $idBanco, \PDO::PARAM_INT);
        $sth->execute();

        if ($bancoBD = $sth->fetch(\PDO::FETCH_OBJ)) {
            $banco = new \model\banco();
            $banco->idBanco = $bancoBD->idBanco;
            $banco->nome = $bancoBD->nome;

            return $banco;
        }

        return false;
    }

    public static function criar(\model\banco $banco) {
        $sql = "INSERT INTO banco(nome) VALUES(:nome)";
        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":nome", $banco->nome, \PDO::PARAM_STR);
        $sth->execute();

        return \controller\Conexao::getConexao()->lastInsertId();
    }

    public static function alterar(\model\banco $banco) {
        $sql = "UPDATE banco SET nome=:nome WHERE idBanco=:idBanco";
        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idBanco", $banco->idBanco, \PDO::PARAM_INT);
        $sth->bindValue(":nome", $banco->nome, \PDO::PARAM_STR);
        $sth->execute();

    }

    public static function excluir(\model\banco $banco) {
        $sql = "DELETE FROM banco WHERE idBanco=:idBanco";
        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idBanco", $banco->idBanco, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->rowCount() == 1;
    }

}
