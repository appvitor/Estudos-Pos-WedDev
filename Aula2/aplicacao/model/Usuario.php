<?php

class Usuario {

    public $idUsuario;
    public $nome;
    public $usuario;
    public $senha;
    public $permissoes = [];

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNome() {
        return $this->nome;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getSenha() {
        return $this->senha;
    }

    function getPermissoes() {
        return $this->permissoes;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setPermissoes($permissoes) {
        $this->permissoes = $permissoes;
    }

    function addPermissao(Permissao $permissao) {
        $this->permissoes[] = $permissao;
    }

}
