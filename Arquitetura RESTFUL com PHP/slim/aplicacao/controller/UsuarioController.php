<?php

class UsuarioController {

    public static function listar() {
        $sql = "SELECT idUsuario, nome, usuario, senha 
                FROM usuario 
                ORDER BY nome";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->execute();

        $usuarios = [];

        while ($usuarioBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $usuario = new Usuario();
            $usuario->idUsuario = $usuarioBD->idUsuario;
            $usuario->nome = $usuarioBD->nome;
            $usuario->usuario = $usuarioBD->usuario;
            $usuario->senha = $usuarioBD->senha;
            $usuarios[] = $usuario;
        }

        return $usuarios;
    }

    public static function recuperar($idUsuario) {
        $sql = "SELECT idUsuario, nome, usuario, senha 
                FROM usuario 
                WHERE idUsuario=:idUsuario";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        if ($usuarioBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $usuario = new Usuario();
            $usuario->idUsuario = $usuarioBD->idUsuario;
            $usuario->nome = $usuarioBD->nome;
            $usuario->usuario = $usuarioBD->usuario;
            $usuario->senha = $usuarioBD->senha;
            return $usuario;
        }

        return false;
    }

    public static function recuperarPorUsuario($usuario) {
        $sql = "SELECT idUsuario, nome, usuario, senha 
                FROM usuario 
                WHERE usuario=:usuario";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->execute();

        if ($usuarioBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $usuario = new Usuario();
            $usuario->idUsuario = $usuarioBD->idUsuario;
            $usuario->nome = $usuarioBD->nome;
            $usuario->usuario = $usuarioBD->usuario;
            $usuario->senha = $usuarioBD->senha;
            return $usuario;
        }

        return false;        
    }
    
    public static function recuperarPorUsuarioSenha($usuario, $senha) {
        $sql = "SELECT idUsuario, nome, usuario, senha 
                FROM usuario 
                WHERE usuario=:usuario AND senha=:senha";

        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindValue(":senha", md5($senha), PDO::PARAM_STR);
        $stmt->execute();

        if ($usuarioBD = $stmt->fetch(PDO::FETCH_OBJ)) {
            $usuario = new Usuario();
            $usuario->idUsuario = $usuarioBD->idUsuario;
            $usuario->nome = $usuarioBD->nome;
            $usuario->usuario = $usuarioBD->usuario;
            $usuario->senha = $usuarioBD->senha;
            return $usuario;
        }

        return false;        
    }

    public static function criar(Usuario $usuario) {
        $sql = "INSERT INTO usuario(nome, usuario, senha) VALUES(:nome, :usuario, :senha)";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":nome", $usuario->nome, PDO::PARAM_STR);
        $stmt->bindValue(":usuario", $usuario->usuario, PDO::PARAM_STR);
        $stmt->bindValue(":senha", $usuario->senha, PDO::PARAM_STR);
        $stmt->execute();
        $idUsuario = Conexao::getConexao()->lastInsertId();
        return $idUsuario;
    }

    public static function alterar(Usuario $usuario) {
        $sql = "UPDATE usuario SET nome=:nome, usuario=:usuario, senha=:senha WHERE idUsuario=:idUsuario";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idUsuario", $usuario->idUsuario, PDO::PARAM_INT);
        $stmt->bindValue(":nome", $usuario->nome, PDO::PARAM_STR);
        $stmt->bindValue(":usuario", $usuario->usuario, PDO::PARAM_STR);
        $stmt->bindValue(":senha", $usuario->senha, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function excluir(Usuario $usuario) {
        $sql = "DELETE FROM usuario WHERE idUsuario=:idUsuario";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(":idUsuario", $usuario->idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() == 1;
    }

}
