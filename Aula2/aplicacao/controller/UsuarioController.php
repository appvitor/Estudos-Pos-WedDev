<?php

class UsuarioController {

    public static function listar() {
        $sql = "SELECT idUsuario, nome, usuario, senha 
                FROM usuario 
                ORDER BY nome";

        $sth = Conexao::getConexao()->prepare($sql);
        $sth->execute();

        $usuarios = [];

        while ($usuarioBD = $sth->fetch(PDO::FETCH_OBJ)) {
            $usuario = new Usuario();
            $usuario->idUsuario = $usuarioBD->idUsuario;
            $usuario->nome = $usuarioBD->nome;
            $usuario->usuario = $usuarioBD->usuario;
            $usuario->senha = $usuarioBD->senha;
            $usuario->permissoes = PermissaoController::listarPorUsuario($usuario);

            $usuarios[] = $usuario;
        }

        return $usuarios;
    }

    public static function recuperar($idUsuario) {
        $sql = "SELECT idUsuario, nome, usuario, senha 
                FROM usuario 
                WHERE idUsuario=:idUsuario";

        $sth = Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
        $sth->execute();

        if ($usuarioBD = $sth->fetch(PDO::FETCH_OBJ)) {
            $usuario = new Usuario();
            $usuario->idUsuario = $usuarioBD->idUsuario;
            $usuario->nome = $usuarioBD->nome;
            $usuario->usuario = $usuarioBD->usuario;
            $usuario->senha = $usuarioBD->senha;
            $usuario->permissoes = PermissaoController::listarPorUsuario($usuario);
            return $usuario;
        }

        return false;
    }

    public static function recuperarPorUsuario($usuario) {
        $sql = "SELECT idUsuario, nome, usuario, senha 
                FROM usuario 
                WHERE usuario=:usuario";

        $sth = Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":usuario", $usuario, PDO::PARAM_STR);
        $sth->execute();

        if ($usuarioBD = $sth->fetch(PDO::FETCH_OBJ)) {
            $usuario = new Usuario();
            $usuario->idUsuario = $usuarioBD->idUsuario;
            $usuario->nome = $usuarioBD->nome;
            $usuario->usuario = $usuarioBD->usuario;
            $usuario->senha = $usuarioBD->senha;
            $usuario->permissoes = PermissaoController::listarPorUsuario($usuario);
            return $usuario;
        }

        return false;        
    }
    
    public static function recuperarPorUsuarioSenha($usuario, $senha) {
        $sql = "SELECT idUsuario, nome, usuario, senha 
                FROM usuario 
                WHERE usuario=:usuario AND senha=:senha";

        $sth = Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":usuario", $usuario, PDO::PARAM_STR);
        $sth->bindValue(":senha", md5($senha), PDO::PARAM_STR);
        $sth->execute();

        if ($usuarioBD = $sth->fetch(PDO::FETCH_OBJ)) {
            $usuario = new Usuario();
            $usuario->idUsuario = $usuarioBD->idUsuario;
            $usuario->nome = $usuarioBD->nome;
            $usuario->usuario = $usuarioBD->usuario;
            $usuario->senha = $usuarioBD->senha;
            $usuario->permissoes = PermissaoController::listarPorUsuario($usuario);
            return $usuario;
        }

        return false;        
    }

    public static function criar(Usuario $usuario) {
        $sql = "INSERT INTO usuario(nome, usuario, senha) VALUES(:nome, :usuario, :senha)";
        $sth = Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":nome", $usuario->nome, PDO::PARAM_STR);
        $sth->bindValue(":usuario", $usuario->usuario, PDO::PARAM_STR);
        $sth->bindValue(":senha", $usuario->senha, PDO::PARAM_STR);
        $sth->execute();
        $idUsuario = Conexao::getConexao()->lastInsertId();

        foreach ($usuario->permissoes as $permissao) {
            $sql = "INSERT INTO usuario_permissao (idUsuario, idPermissao) VALUES(:idUsuario, :idPermissao)";
            $sth = Conexao::getConexao()->prepare($sql);
            $sth->bindValue(":idUsuario", $idUsuario, PDO::PARAM_STR);
            $sth->bindValue(":idPermissao", $permissao->idPermissao, PDO::PARAM_STR);
            $sth->execute();
        }

        return $idUsuario;
    }

    public static function alterar(Usuario $usuario) {
        $sql = "UPDATE usuario SET nome=:nome, usuario=:usuario, senha=:senha WHERE idUsuario=:idUsuario";
        $sth = Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idUsuario", $usuario->idUsuario, PDO::PARAM_INT);
        $sth->bindValue(":nome", $usuario->nome, PDO::PARAM_STR);
        $sth->bindValue(":usuario", $usuario->usuario, PDO::PARAM_STR);
        $sth->bindValue(":senha", $usuario->senha, PDO::PARAM_STR);
        $sth->execute();

        $sql = "DELETE FROM usuario_permissao WHERE idUsuario=:idUsuario";
        $sth = Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idUsuario", $usuario->idUsuario, PDO::PARAM_STR);
        $sth->execute();

        foreach ($usuario->permissoes as $permissao) {
            $sql = "INSERT INTO usuario_permissao (idUsuario, idPermissao) VALUES(:idUsuario, :idPermissao)";
            $sth = Conexao::getConexao()->prepare($sql);
            $sth->bindValue(":idUsuario", $usuario->idUsuario, PDO::PARAM_STR);
            $sth->bindValue(":idPermissao", $permissao->idPermissao, PDO::PARAM_STR);
            $sth->execute();
        }
    }

    public static function excluir(Usuario $usuario) {
        $sql = "DELETE FROM usuario WHERE idUsuario=:idUsuario";
        $sth = Conexao::getConexao()->prepare($sql);
        $sth->bindValue(":idUsuario", $usuario->idUsuario, PDO::PARAM_INT);
        $sth->execute();

        return $sth->rowCount() == 1;
    }

}
