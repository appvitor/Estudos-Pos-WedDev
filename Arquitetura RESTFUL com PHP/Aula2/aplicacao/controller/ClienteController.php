<?php

class ClienteController {

    public static function listar() {

        if ($clientes = Conexao::getCache()->get("clientes")) {
            return $clientes;
        }

        $sql = "SELECT idCliente, nome, cpf 
					FROM cliente 
					ORDER BY nome";

        $sth = Conexao::getConexao()->prepare($sql);
        $sth->execute();

        $clientes = [];

        while ($clienteBD = $sth->fetch(PDO::FETCH_OBJ)) {
            $cliente = new Cliente();
            $cliente->idCliente = $clienteBD->idCliente;
            $cliente->nome = $clienteBD->nome;
            $cliente->cpf = $clienteBD->cpf;
            $clientes[] = $cliente;
        }

        Conexao::getCache()->set("clientes", $clientes, MEMCACHE_COMPRESSED);

        return $clientes;
    }

    public static function recuperar($idCliente) {

        if ($cliente = Conexao::getCache()->get("cliente_{$idCliente}")) {
            return $cliente;
        }

        $sql = "SELECT idCliente, nome, cpf 
                FROM cliente 
                WHERE idCliente=:idCliente";

        $sth = Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idCliente", $idCliente, PDO::PARAM_INT);
        $sth->execute();

        if ($clienteBD = $sth->fetch(PDO::FETCH_OBJ)) {
            $cliente = new Cliente();
            $cliente->idCliente = $clienteBD->idCliente;
            $cliente->nome = $clienteBD->nome;
            $cliente->cpf = $clienteBD->cpf;

            Conexao::getCache()->set("cliente_{$cliente->idCliente}", $cliente, MEMCACHE_COMPRESSED);

            return $cliente;
        }

        return false;
    }

    public static function criar(Cliente $cliente) {
        $sql = "INSERT INTO cliente(nome, cpf) VALUES(:nome, :cpf)";
        $sth = Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":nome", $cliente->nome, PDO::PARAM_STR);
        $sth->bindValue(":cpf", $cliente->cpf, PDO::PARAM_STR);
        $sth->execute();

        Conexao::getCache()->delete("clientes");

        return Conexao::getConexao()->lastInsertId();
    }

    public static function alterar(Cliente $cliente) {
        $sql = "UPDATE cliente SET nome=:nome, cpf=:cpf WHERE idCliente=:idCliente";
        $sth = Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idCliente", $cliente->idCliente, PDO::PARAM_INT);
        $sth->bindValue(":nome", $cliente->nome, PDO::PARAM_STR);
        $sth->bindValue(":cpf", $cliente->cpf, PDO::PARAM_STR);
        $sth->execute();

        Conexao::getCache()->delete("cliente_{$cliente->idCliente}");
        Conexao::getCache()->delete("clientes");
    }

    public static function excluir(Cliente $cliente) {
        $sql = "DELETE FROM cliente WHERE idCliente=:idCliente";
        $sth = Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idCliente", $cliente->idCliente, PDO::PARAM_INT);
        $sth->execute();

        Conexao::getCache()->delete("cliente_{$cliente->idCliente}");
        Conexao::getCache()->delete("clientes");

        return $sth->rowCount() == 1;
    }

}
