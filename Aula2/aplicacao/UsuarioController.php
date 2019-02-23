<?php

	class UsuarioController {

		public static function listar() {

			$sql = 'SELECT idUsuario, nome, usuario, senha 
					FROM usuario 
					ORDER BY nome';

			$sth = Conexao::getConexao()->prepare($sql); //statement preparando o comando p/ enviar
			$sth->execute(); //envie e execute o comando

			$usuarios = [];

			while ($usuarioBD = $sth->fetch(PDO::FETCH_OBJ)) {
				
				$usuario = new Cliente();
				$usuario->idCliente = $usuarioBD->idCliente; //a variavel cliente recebe o dado da variavel usuarioBD que veio do Banco de Dados
				$usuario->nome = $usuarioBD->nome;
				$usuario->cpf = $usuarioBD->cpf;
				$usuarios[]=$usuario; //adicionar ao array de usuarios == array_push()
			}

			return $usuarios; //ao pegar os usuarios, retorne a lista
		}

		public static function recuperar($idCliente){
			$sql = 'SELECT idCliente, nome, cpf 
					FROM cliente 
					WHERE idCliente = :idCliente';
					//especificando qual idCliente busco através da comparação com a variavel
			
			$sth = Conexao::getConexao()->prepare($sql); //statement preparando o comando p/ enviar
			$sth->bindValue(':idCliente', $idCliente, PDO::PARAM_INT); //o terceiro atributo indica o tipo de dado que eu quero ao receber a informação do banco
			$sth->execute(); //envie e execute o comando

			if ($usuarioBD = $sth->fetch(PDO::FETCH_OBJ)) {
				
				$usuario = new Cliente();
				$usuario->idCliente = $usuarioBD->idCliente; //a variavel cliente recebe o dado da variavel usuarioBD que veio do Banco de Dados
				$usuario->nome = $usuarioBD->nome;
				$usuario->cpf = $usuarioBD->cpf;
				return $usuario;
			}				

			return false; //como o id nao foi encontrado, retorne falso
		}

		public static function criar(Cliente $usuario) {

			$sql = 'INSERT INTO cliente(nome, cpf)
					VALUES (:nome, :cpf)';
			$sth = Conexao::getConexao()->prepare($sql);
			$sth->bindValue(':nome', $usuario->nome, PDO::PARAM_STR);
			$sth->bindValue(':cpf', $usuario->cpf, PDO::PARAM_STR);
			$sth->execute();
			return Conexao::getConexao()->lastInsertId();
		}

		public static function alterar(Cliente $usuario) {
			
			$sql = 'UPDATE cliente SET nome=:nome, cpf=:cpf WHERE idCliente=:idCliente';
			$sth = Conexao::getConexao()->prepare($sql);
			$sth->bindValue('idCliente', $usuario->idCliente, PDO::PARAM_INT);
			$sth->bindValue(':nome', $usuario->nome, PDO::PARAM_STR);
			$sth->bindValue(':cpf', $usuario->cpf, PDO::PARAM_STR);
			$sth->execute();
		}

		public static function excluir(Cliente $usuario) {
			
			$sql = 'DELETE FROM cliente WHERE idCliente=:idCliente';
			$sth = Conexao::getConexao()->prepare($sql);
			$sth->bindValue(':idCliente', $usuario->idCliente, PDO::PARAM_INT);
			$sth->execute();

			return $sth->rowCount() == 1;
		}

	}

?>