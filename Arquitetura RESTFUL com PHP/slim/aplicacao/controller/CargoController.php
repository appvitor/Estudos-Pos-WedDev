<?php

class CargoController {

    public static function listar() {
        $sql = "SELECT idCargo, nome 
                FROM cargo 
                ORDER BY idCargo";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->execute();

        $cargos = [];

        while ($cargoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $cargo = new Cargo();
            $cargo->idCargo = $cargoBD->idCargo;
            $cargo->nome = $cargoBD->nome;

            $cargos[] = $cargo;
        }

        return $cargos;
    }

    public static function recuperar($idCargo) {
        $sql = "SELECT idCargo, nome
                FROM cargo 
                WHERE idCargo=:idCargo";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idCargo", $idCargo, PDO::PARAM_INT);
        $stmt->execute();

        if ($cargoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $cargo = new Cargo();
            $cargo->idCargo = $cargoBD->idCargo;
            $cargo->nome = $cargoBD->nome;
            return $cargo;
        }

        return false;
    }

    public static function recuperarPorNome($cargo) {
        $sql = "SELECT idCargo, nome
                FROM cargo 
                WHERE nome=:nome";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":cargo", $cargo, PDO::PARAM_STR);
        $stmt->execute();

        if ($cargoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $cargo = new Cargo();
            $cargo->idCargo = $cargoBD->idCargo;
            $cargo->nome = $cargoBD->nome;
            return $cargo;
        }

        return false;        
    }

    public static function criar(Cargo $cargo) {
        $sql = "INSERT INTO cargo(nome) VALUES(:nome)";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":nome", $cargo->nome, PDO::PARAM_STR);
        $stmt->execute();
        $idCargo = Conexao::getConexao()->lastInsertId();
        return $idCargo;
    }

    public static function alterar(Cargo $cargo) {
        $sql = "UPDATE candidato SET nome=:nome WHERE idCargo=:idCargo";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idCargo", $cargo->idCargo, PDO::PARAM_INT);
        $stmt->bindValue(":descricao", $cargo->nome, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function excluir(Cargo $cargo) {
        $sql = "DELETE FROM cargo WHERE idCargo=:idCargo";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idCargo", $cargo->idCargo, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

}
