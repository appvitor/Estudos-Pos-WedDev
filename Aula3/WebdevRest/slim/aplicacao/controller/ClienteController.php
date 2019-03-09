<?php

namespace controller;

class ClienteController {

    public static function listar() {

        $sql = "SELECT idCliente, nome, cpf 
					FROM cliente 
					ORDER BY nome";

        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->execute();

        $clientes = [];

        while ($clienteBD = $sth->fetch(\PDO::FETCH_OBJ)) {
            $cliente = new \model\Cliente();
            $cliente->idCliente = $clienteBD->idCliente;
            $cliente->nome = $clienteBD->nome;
            $cliente->cpf = $clienteBD->cpf;
            $clientes[] = $cliente;
        }


        return $clientes;
    }

    public static function recuperar($idCliente) {

        $sql = "SELECT idCliente, nome, cpf 
                FROM cliente 
                WHERE idCliente=:idCliente";

        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idCliente", $idCliente, \PDO::PARAM_INT);
        $sth->execute();

        if ($clienteBD = $sth->fetch(\PDO::FETCH_OBJ)) {
            $cliente = new \model\Cliente();
            $cliente->idCliente = $clienteBD->idCliente;
            $cliente->nome = $clienteBD->nome;
            $cliente->cpf = $clienteBD->cpf;

            return $cliente;
        }

        return false;
    }

    public static function criar(\model\Cliente $cliente) {
        $sql = "INSERT INTO cliente(nome, cpf) VALUES(:nome, :cpf)";
        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":nome", $cliente->nome, \PDO::PARAM_STR);
        $sth->bindValue(":cpf", $cliente->cpf, \PDO::PARAM_STR);
        $sth->execute();

        return \controller\Conexao::getConexao()->lastInsertId();
    }

    public static function alterar(\model\Cliente $cliente) {
        $sql = "UPDATE cliente SET nome=:nome, cpf=:cpf WHERE idCliente=:idCliente";
        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idCliente", $cliente->idCliente, \PDO::PARAM_INT);
        $sth->bindValue(":nome", $cliente->nome, \PDO::PARAM_STR);
        $sth->bindValue(":cpf", $cliente->cpf, \PDO::PARAM_STR);
        $sth->execute();

    }

    public static function excluir(\model\Cliente $cliente) {
        $sql = "DELETE FROM cliente WHERE idCliente=:idCliente";
        $sth = \controller\Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idCliente", $cliente->idCliente, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->rowCount() == 1;
    }

}
