<?php

class EstadoController {

    public static function listar() {
        $sql = "SELECT idEstado, nome, sigla 
                FROM estado 
                ORDER BY idEstado";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->execute();

        $estados = [];

        while ($estadoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $estado = new Estado();
            $estado->idEstado = $estadoBD->idEstado;
            $estado->nome = $estadoBD->nome;
            $estado->sigla = $estadoBD->sigla;

            $estados[] = $estado;
        }

        return $estados;
    }

    public static function recuperar($idEstado) {
        $sql = "SELECT idEstado, nome, sigla
                FROM estado 
                WHERE idEstado=:idEstado";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idEstado", $idEstado, PDO::PARAM_INT);
        $stmt->execute();

        if ($estadoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $estado = new Estado();
            $estado->idEstado = $estadoBD->idEstado;
            $estado->nome = $estadoBD->nome;
            $estado->sigla = $estadoBD->sigla;
            return $estado;
        }

        return false;
    }

    public static function recuperarPorCandidato($estado) {
        $sql = "SELECT idEstado, nome, sigla
                FROM estado 
                WHERE estado=:estado";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":usuario", $estado, PDO::PARAM_STR);
        $stmt->execute();

        if ($estadoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $estado = new Estado();
            $estado->idEstado = $estadoBD->idEstado;
            $estado->nome = $estadoBD->nome;
            $estado->sigla = $estadoBD->sigla;
            return $estado;
        }

        return false;        
    }
    
    public static function recuperarPorSigla($sigla) {
        $sql = "SELECT idEstado, nome, sigla 
                FROM estado 
                WHERE sigla=:sigla";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":sigla", $sigla, PDO::PARAM_STR);
        $stmt->execute();

        if ($estadoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $estado = new Estado();
            $estado->idEstado = $estadoBD->idEstado;
            $estado->nome = $estadoBD->nome;
            $estado->sigla = $estadoBD->sigla;
            return $estado;
        }

        return false;        
    }

    public static function criar(Estado $estado) {
        $sql = "INSERT INTO estado(nome, sigla) VALUES(:nome, :sigla)";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":nome", $estado->nome, PDO::PARAM_STR);
        $stmt->bindValue(":sigla", $estado->sigla, PDO::PARAM_STR);
        $stmt->execute();
        $idEstado = Conexao::getConexao()->lastInsertId();
        return $idEstado;
    }

    public static function alterar(Estado $estado) {
        $sql = "UPDATE estado SET nome=:nome, sigla=:sigla WHERE idEstado=:idEstado";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":nome", $estado->nome, PDO::PARAM_STR);
        $stmt->bindValue(":sigla", $estado->sigla, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function excluir(Estado $estado) {
        $sql = "DELETE FROM estado WHERE idEstado=:idEstado";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idEstado", $estado->idEstado, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

}
