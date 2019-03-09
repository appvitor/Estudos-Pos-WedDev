<?php

class Cargo {

    public $idCargo;
    public $nome;

    function getIdCargo() {
        return $this->idCargo;
    }

    function getNome() {
        return $this->nome;
    }

    function setIdCargo($idCargo) {
        $this->idCargo = $idCargo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

}
