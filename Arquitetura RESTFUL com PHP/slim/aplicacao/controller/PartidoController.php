<?php

class PartidoController {

    public static function listar() {
        $sql = "SELECT idPartido, nome, legenda 
                FROM partido 
                ORDER BY idPartido";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->execute();

        $partidos = [];

        while ($partidoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $partido = new Partido();
            $partido->idPartido = $partidoBD->idPartido;
            $partido->nome = $partidoBD->nome;
            $partido->legenda = $partidoBD->legenda;

            $partidos[] = $partido;
        }

        return $partidos;
    }

    public static function recuperar($idPartido) {
        $sql = "SELECT idPartido, nome, legenda
                FROM partido 
                WHERE idPartido=:idPartido";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idPartido", $idPartido, PDO::PARAM_INT);
        $stmt->execute();

        if ($partidoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $partido = new Partido();
            $partido->idPartido = $partidoBD->idPartido;
            $partido->nome = $partidoBD->nome;
            $partido->legenda = $partidoBD->legenda;
            return $partido;
        }

        return false;
    }

    public static function recuperarPorCandidato($partido) {
        $sql = "SELECT idPartido, nome, legenda
                FROM partido 
                WHERE estado=:estado";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":usuario", $partido, PDO::PARAM_STR);
        $stmt->execute();

        if ($partidoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $partido = new Partido();
            $partido->idPartido = $partidoBD->idPartido;
            $partido->nome = $partidoBD->nome;
            $partido->legenda = $partidoBD->legenda;
            return $partido;
        }

        return false;        
    }
    
    public static function recuperarPorlegenda($legenda) {
        $sql = "SELECT idPartido, nome, legenda 
                FROM partido 
                WHERE legenda=:legenda";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":legenda", $legenda, PDO::PARAM_STR);
        $stmt->execute();

        if ($partidoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $partido = new Partido();
            $partido->idPartido = $partidoBD->idPartido;
            $partido->nome = $partidoBD->nome;
            $partido->legenda = $partidoBD->legenda;
            return $partido;
        }

        return false;        
    }

    public static function criar(Estado $partido) {
        $sql = "INSERT INTO estado(nome, legenda) VALUES(:nome, :legenda)";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":nome", $partido->nome, PDO::PARAM_STR);
        $stmt->bindValue(":legenda", $partido->legenda, PDO::PARAM_STR);
        $stmt->execute();
        $idPartido = Conexao::getConexao()->lastInsertId();
        return $idPartido;
    }

    public static function alterar(Estado $partido) {
        $sql = "UPDATE estado SET nome=:nome, legenda=:legenda WHERE idPartido=:idPartido";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":nome", $partido->nome, PDO::PARAM_STR);
        $stmt->bindValue(":legenda", $partido->legenda, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function excluir(Estado $partido) {
        $sql = "DELETE FROM partido WHERE idPartido=:idPartido";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idPartido", $partido->idPartido, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

}
