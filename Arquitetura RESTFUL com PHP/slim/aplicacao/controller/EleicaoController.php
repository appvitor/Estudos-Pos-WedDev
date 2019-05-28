<?php

class EleicaoController {

    public static function listar() {
        $sql = "SELECT idEleicao, nome, ano 
                FROM eleicao 
                ORDER BY idEleicao";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->execute();

        $eleicoes = [];

        while ($eleicaoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $eleicao = new Eleicao();
            $eleicao->idEleicao = $eleicaoBD->idEleicao;
            $eleicao->nome = $eleicaoBD->nome;
            $eleicao->ano = $eleicaoBD->ano;

            $eleicoes[] = $eleicao;
        }

        return $eleicoes;
    }

    public static function recuperar($idEleicao) {
        $sql = "SELECT idEleicao, nome, ano
                FROM bem 
                WHERE idEleicao=:idEleicao";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idEleicao", $idEleicao, PDO::PARAM_INT);
        $stmt->execute();

        if ($eleicaoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $eleicao = new Eleicao();
            $eleicao->idEleicao = $eleicaoBD->idEleicao;
            $eleicao->nome = $eleicaoBD->nome;
            $eleicao->ano = $eleicaoBD->ano;
            return $eleicao;
        }

        return false;
    }

    public static function recuperarPorNome($nome) {
        $sql = "SELECT idEleicao, nome, ano
                FROM eleicao 
                WHERE nome=:nome";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":nome", $nome, PDO::PARAM_STR);
        $stmt->execute();

        if ($eleicaoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $eleicao = new Eleicao();
            $eleicao->idEleicao = $eleicaoBD->idEleicao;
            $eleicao->nome = $eleicaoBD->nome;
            $eleicao->ano = $eleicaoBD->ano;
            return $eleicao;
        }

        return false;        
    }
    
    public static function recuperarPorAno($ano) {
        $sql = "SELECT idEleicao, nome, ano 
                FROM eleicao 
                WHERE ano=:ano";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":ano", $ano, PDO::PARAM_STR);
        $stmt->execute();

        if ($eleicaoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $eleicao = new Eleicao();
            $eleicao->idEleicao = $eleicaoBD->idEleicao;
            $eleicao->nome = $eleicaoBD->nome;
            $eleicao->ano = $eleicaoBD->ano;
            return $eleicao;
        }

        return false;        
    }

    public static function criar(Eleicao $eleicao) {
        $sql = "INSERT INTO eleicao(nome, ano) VALUES(:nome, :ano)";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":nome", $eleicao->nome, PDO::PARAM_STR);
        $stmt->bindValue(":ano", $eleicao->ano, PDO::PARAM_STR);
        $stmt->execute();
        $idEleicao = Conexao::getConexao()->lastInsertId();
        return $idEleicao;
    }

    public static function alterar(Eleicao $eleicao) {
        $sql = "UPDATE eleicao SET nome=:nome, ano=:ano WHERE idEleicao=:idEleicao";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idEleicao", $eleicao->idEleicao, PDO::PARAM_INT);
        $stmt->bindValue(":nome", $eleicao->nome, PDO::PARAM_STR);
        $stmt->bindValue(":ano", $eleicao->ano, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function excluir(Eleicao $eleicao) {
        $sql = "DELETE FROM eleicao WHERE idEleicao=:idEleicao";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idEleicao", $eleicao->idEleicao, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

}
