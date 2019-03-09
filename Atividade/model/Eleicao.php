<?php

class Eleicao {

    public $idEleicao;
    public $nome;
    public $ano;

    function getIdEleicao() {
        return $this->idEleicao;
    }

    function getNome() {
        return $this->nome;
    }

    function getAno() {
        return $this->ano;
    }

    function setIdEleicao($idEleicao) {
        $this->idEleicao = $idEleicao;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }

}
