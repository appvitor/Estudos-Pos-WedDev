<?php

class BemController {

    public static function listar() {
        $sql = "SELECT idBem, descricao, valor 
                FROM bem 
                ORDER BY idBem";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->execute();

        $bens = [];

        while ($bemBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $bem = new Bem();
            $bem->idBem = $bemBD->idBem;
            $bem->descricao = $bemBD->descricao;
            $bem->valor = $bemBD->valor;

            $bens[] = $bem;
        }

        return $bens;
    }

    public static function recuperar($idBem) {
        $sql = "SELECT idBem, descricao, valor
                FROM bem 
                WHERE idBem=:idBem";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idBem", $idBem, PDO::PARAM_INT);
        $stmt->execute();

        if ($bemBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $bem = new Bem();
            $bem->idBem = $bemBD->idBem;
            $bem->descricao = $bemBD->descricao;
            $bem->valor = $bemBD->valor;
            return $bem;
        }

        return false;
    }

    public static function recuperarPorDescricao($descricao) {
        $sql = "SELECT idBem, descricao, valor
                FROM bem 
                WHERE descricao=:descricao";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":descricao", $descricao, PDO::PARAM_STR);
        $stmt->execute();

        if ($bemBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $bem = new Bem();
            $bem->idBem = $bemBD->idBem;
            $bem->descricao = $bemBD->descricao;
            $bem->valor = $bemBD->valor;
            return $bem;
        }

        return false;        
    }
    
    public static function recuperarPorValor($valor) {
        $sql = "SELECT idBem, descricao, valor
                FROM bem 
                WHERE valor=:valor";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":valor", $valor, PDO::PARAM_STR);
        $stmt->execute();

        if ($bemBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $bem = new Bem();
            $bem->idBem = $bemBD->idBem;
            $bem->descricao = $bemBD->descricao;
            $bem->valor = $bemBD->valor;
            return $bem;
        }

        return false;        
    }

    public static function criar(Bem $bem) {
        $sql = "INSERT INTO bem(descricao, valor) VALUES(:descricao, :valor)";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":descricao", $bem->descricao, PDO::PARAM_STR);
        $stmt->bindValue(":valor", $bem->valor, PDO::PARAM_STR);
        $stmt->execute();
        $idBem = Conexao::getConexao()->lastInsertId();
        return $idBem;
    }

    public static function alterar(Bem $bem) {
        $sql = "UPDATE bem SET descricao=:descricao, valor=:valor WHERE idBem=:idBem";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idBem", $bem->idBem, PDO::PARAM_INT);
        $stmt->bindValue(":descricao", $bem->descricao, PDO::PARAM_STR);
        $stmt->bindValue(":valor", $bem->valor, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function excluir(Bem $bem) {
        $sql = "DELETE FROM bem WHERE idBem=:idBem";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idBem", $bem->idBem, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

}
