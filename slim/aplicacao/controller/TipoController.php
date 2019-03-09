<?php

class TipoController {

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

    public static function recuperarPorCandidato($bem) {
        $sql = "SELECT idBem, descricao, valor
                FROM bem 
                WHERE candidato=:candidato";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":usuario", $bem, PDO::PARAM_STR);
        $stmt->execute();

        if ($bemBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $bem = new Candidato();
            $bem->idBem = $bemBD->idBem;
            $bem->descricao = $bemBD->descricao;
            $bem->valor = $bemBD->valor;
            return $bem;
        }

        return false;        
    }
    
    public static function recuperarPorCandidatovalor($bem, $senha) {
        $sql = "SELECT idBem, descricao, valor, apto 
                FROM candidato 
                WHERE candidato=:candidato AND valor=:valor";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":candidato", $bem, PDO::PARAM_STR);
        $stmt->bindValue(":valor", $valor, PDO::PARAM_STR);
        $stmt->execute();

        if ($bemBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $bem = new Candidato();
            $bem->idBem = $bemBD->idBem;
            $bem->descricao = $bemBD->descricao;
            $bem->valor = $bemBD->valor;
            return $bem;
        }

        return false;        
    }

    public static function criar(Candidato $bem) {
        $sql = "INSERT INTO candidato(descricao, valor) VALUES(:descricao, :valor)";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":descricao", $bem->descricao, PDO::PARAM_STR);
        $stmt->bindValue(":valor", $bem->valor, PDO::PARAM_STR);
        $stmt->execute();
        $idBem = Conexao::getConexao()->lastInsertId();
        return $idBem;
    }

    public static function alterar(Candidato $bem) {
        $sql = "UPDATE candidato SET descricao=:descricao, valor=:valor WHERE idBem=:idBem";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idBem", $bem->idBem, PDO::PARAM_INT);
        $stmt->bindValue(":descricao", $bem->descricao, PDO::PARAM_STR);
        $stmt->bindValue(":valor", $bem->valor, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function excluir(Usuario $bem) {
        $sql = "DELETE FROM candidato WHERE idBem=:idBem";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idBem", $bem->idBem, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

}
