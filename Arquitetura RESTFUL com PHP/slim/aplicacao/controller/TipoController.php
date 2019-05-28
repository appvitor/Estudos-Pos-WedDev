<?php

class TipoController {

    public static function listar() {
        $sql = "SELECT idTipo, nome 
                FROM tipo 
                ORDER BY idTipo";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->execute();

        $bens = [];

        while ($tipoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tipo = new tipo();
            $tipo->idTipo = $tipoBD->idTipo;
            $tipo->nome = $tipoBD->nome;
            $tipo->valor = $tipoBD->valor;

            $bens[] = $tipo;
        }

        return $bens;
    }

    public static function recuperar($idTipo) {
        $sql = "SELECT idTipo, nome
                FROM tipo 
                WHERE idTipo=:idTipo";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idTipo", $idTipo, PDO::PARAM_INT);
        $stmt->execute();

        if ($tipoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tipo = new tipo();
            $tipo->idTipo = $tipoBD->idTipo;
            $tipo->nome = $tipoBD->nome;
            return $tipo;
        }

        return false;
    }

    public static function recuperarPorNome($nome) {
        $sql = "SELECT idTipo, nome
                FROM tipo 
                WHERE nome=:nome";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":nome", $nome, PDO::PARAM_STR);
        $stmt->execute();

        if ($tipoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tipo = new Tipo();
            $tipo->idTipo = $tipoBD->idTipo;
            $tipo->nome = $tipoBD->nome;
            return $tipo;
        }

        return false;        
    }

    public static function criar(Tipo $tipo) {
        $sql = "INSERT INTO tipo(nome) VALUES(:nome)";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":nome", $tipo->nome, PDO::PARAM_STR);
        $stmt->execute();
        $idTipo = Conexao::getConexao()->lastInsertId();
        return $idTipo;
    }

    public static function alterar(Tipo $tipo) {
        $sql = "UPDATE tipo SET nome=:nome WHERE idTipo=:idTipo";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idTipo", $tipo->idTipo, PDO::PARAM_INT);
        $stmt->bindValue(":nome", $tipo->nome, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function excluir(Tipo $tipo) {
        $sql = "DELETE FROM tipo WHERE idTipo=:idTipo";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idTipo", $tipo->idTipo, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

}
