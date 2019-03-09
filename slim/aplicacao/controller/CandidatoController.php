<?php

class CandidatoController {

    public static function listar() {
        $sql = "SELECT idCandidato, nome, cpf, apto 
                FROM candidato 
                ORDER BY nome";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->execute();

        $candidatos = [];

        while ($candidatoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $candidato = new Candidato();
            $candidato->idCandidato = $candidatoBD->idCandidato;
            $candidato->nome = $candidatoBD->nome;
            $candidato->cpf = $candidatoBD->cpf;
            $candidato->apto = $candidatoBD->apto;

            $candidatos[] = $candidato;
        }

        return $candidatos;
    }

    public static function recuperar($idCandidato) {
        $sql = "SELECT idCandidato, nome, cpf, apto 
                FROM candidato 
                WHERE idCandidato=:idCandidato";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idCandidato", $idCandidato, PDO::PARAM_INT);
        $stmt->execute();

        if ($candidatoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $candidato = new Candidato();
            $candidato->idCandidato = $candidatoBD->idCandidato;
            $candidato->nome = $candidatoBD->nome;
            $candidato->cpf = $candidatoBD->cpf;
            $candidato->apto = $candidatoBD->apto;
            return $candidato;
        }

        return false;
    }
    
    public static function recuperarPorCpf($cpf) {
        $sql = "SELECT idCandidato, nome, cpf, apto 
                FROM candidato 
                WHERE cpf=:cpf";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":cpf", $cpf, PDO::PARAM_STR);
        $stmt->execute();

        if ($candidatoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $candidato = new Candidato();
            $candidato->idCandidato = $candidatoBD->idCandidato;
            $candidato->nome = $candidatoBD->nome;
            $candidato->cpf = $candidatoBD->cpf;
            $candidato->apto = $candidatoBD->apto;
            return $candidato;
        }

        return false;        
    }

    public static function criar(Candidato $candidato) {
        $sql = "INSERT INTO candidato(nome, cpf, apto) VALUES(:nome, :cpf, :apto)";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":nome", $candidato->nome, PDO::PARAM_STR);
        $stmt->bindValue(":cpf", $candidato->cpf, PDO::PARAM_STR);
        $stmt->bindValue(":apto", $candidato->apto, PDO::PARAM_STR);
        $stmt->execute();
        $idCandidato = Conexao::getConexao()->lastInsertId();
        return $idCandidato;
    }

    public static function alterar(Candidato $candidato) {
        $sql = "UPDATE candidato SET nome=:nome, cpf=:cpf, apto=:apto WHERE idCandidato=:idCandidato";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idCandidato", $candidato->idCandidato, PDO::PARAM_INT);
        $stmt->bindValue(":nome", $candidato->nome, PDO::PARAM_STR);
        $stmt->bindValue(":cpf", $candidato->cpf, PDO::PARAM_STR);
        $stmt->bindValue(":apto", $candidato->apto, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function excluir(Candidato $candidato) {
        $sql = "DELETE FROM candidato WHERE idCandidato=:idCandidato";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idCandidato", $candidato->idCandidato, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

}
