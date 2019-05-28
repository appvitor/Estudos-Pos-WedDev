<?php

namespace model;

class Permissao {

    public $idPermissao;
    public $descricao;
    public $chave;

    function getIdPermissao() {
        return $this->idPermissao;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getChave() {
        return $this->chave;
    }

    function setIdPermissao($idPermissao) {
        $this->idPermissao = $idPermissao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setChave($chave) {
        $this->chave = $chave;
    }

}
