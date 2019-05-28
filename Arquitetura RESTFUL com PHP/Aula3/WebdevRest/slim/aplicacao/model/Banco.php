<?php

namespace model;

class Banco {

    public $idBanco;
    public $nome;

    function getIdBanco() {
        return $this->idBanco;
    }

    function getNome() {
        return $this->nome;
    }

    function setIdBanco($idBanco) {
        $this->idBanco = $idBanco;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }


}

?>