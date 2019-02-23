<?php

	class ClienteController {

		public static function listar() {

			$sql = 'SELECT idCliente, nome, cpf 
					FROM cliente 
					ORDER BY nome';

			$sth = Conexao::getConexao()->prepare($sql); //statement preparando o comando p/ enviar
			$sth->execute(); //envie e execute o comando

			$clientes = [];

			while ($clienteBD = $sth->fetch(PDO::FETCH_OBJ)) {
				
				$cliente = new Cliente();
				$cliente->idCliente = $clienteBD->idCliente; //a variavel cliente recebe o dado da variavel clienteBD que veio do Banco de Dados
				$cliente->nome = $clienteBD->nome;
				$cliente->cpf = $clienteBD->cpf;
				$clientes[]=$cliente; //adicionar ao array de clientes == array_push()
			}

			return $clientes; //ao pegar os clientes, retorne a lista
		}

		public static function recuperar($idCliente){
			$sql = 'SELECT idCliente, nome, cpf 
					FROM cliente 
					WHERE idCliente = :idCliente';
					//especificando qual idCliente busco através da comparação com a variavel
			
			$sth = Conexao::getConexao()->prepare($sql); //statement preparando o comando p/ enviar
			$sth->bindValue(':idCliente', $idCliente, PDO::PARAM_INT); //o terceiro atributo indica o tipo de dado que eu quero ao receber a informação do banco
			$sth->execute(); //envie e execute o comando

			if ($clienteBD = $sth->fetch(PDO::FETCH_OBJ)) {
				
				$cliente = new Cliente();
				$cliente->idCliente = $clienteBD->idCliente; //a variavel cliente recebe o dado da variavel clienteBD que veio do Banco de Dados
				$cliente->nome = $clienteBD->nome;
				$cliente->cpf = $clienteBD->cpf;
				return $cliente;
			}				

			return false; //como o id nao foi encontrado, retorne falso
		}

		public static function criar(Cliente $cliente) {

			$sql = 'INSERT INTO cliente(nome, cpf)
					VALUES (:nome, :cpf)';
			$sth = Conexao::getConexao()->prepare($sql);
			$sth->bindValue(':nome', $cliente->nome, PDO::PARAM_STR);
			$sth->bindValue(':cpf', $cliente->cpf, PDO::PARAM_STR);
			$sth->execute();
			return Conexao::getConexao()->lastInsertId();
		}

		public static function alterar(Cliente $cliente) {
			
			$sql = 'UPDATE cliente SET nome=:nome, cpf=:cpf WHERE idCliente=:idCliente';
			$sth = Conexao::getConexao()->prepare($sql);
			$sth->bindValue('idCliente', $cliente->idCliente, PDO::PARAM_INT);
			$sth->bindValue(':nome', $cliente->nome, PDO::PARAM_STR);
			$sth->bindValue(':cpf', $cliente->cpf, PDO::PARAM_STR);
			$sth->execute();
		}

		public static function excluir(Cliente $cliente) {
			
			$sql = 'DELETE FROM cliente WHERE idCliente=:idCliente';
			$sth = Conexao::getConexao()->prepare($sql);
			$sth->bindValue(':idCliente', $cliente->idCliente, PDO::PARAM_INT);
			$sth->execute();

			return $sth->rowCount() == 1;
		}

	}

?>