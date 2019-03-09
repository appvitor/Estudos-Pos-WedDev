<?php

class Partido {

    public $idPartido;
    public $nome;
    public $legenda;

    function getIdPartido() {
        return $this->idPartido;
    }

    function getNome() {
        return $this->nome;
    }

    function getLegenda() {
        return $this->legenda;
    }

    function setIdPartido($idPartido) {
        $this->idPartido = $idPartido;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLegenda($legenda) {
        $this->legenda = $legenda;
    }

}
