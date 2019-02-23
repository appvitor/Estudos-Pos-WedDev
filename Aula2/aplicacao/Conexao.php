<?php

	class Conexao {
		private static $conexao;

		public static function getConexao(){

			if(!self::$conexao){ //self é a mesma coisa que o this, mas é usado apenas p/ atributos estaticos

				self::$conexao = new PDO("mysql:host=localhost;dbname=webdev", "root", "");
				self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //observador de erros, p/ que possam ser tratados caso ocorram

			}

			return self::$conexao;
		}
	}

?>