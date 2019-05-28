<?php

class Tipo {

    public $idTipo;
    public $nome;
//------------------------------------------
    function getIdTipo() {
        return $this->idTipo;
    }

    function getNome() {
        return $this->nome;
    }
//--------------------------------------------------
    function setIdTipo($idTipo) {
        $this->idTipo = $idTipo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

}
