<?php

class Estado {

    public $idEstado;
    public $nome;
    public $sigla;

    function getIdEstado() {
        return $this->idEstado;
    }

    function getNome() {
        return $this->nome;
    }

    function getSigla() {
        return $this->sigla;
    }

    function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSigla($sigla) {
        $this->sigla = $sigla;
    }

}
