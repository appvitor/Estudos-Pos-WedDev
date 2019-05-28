<?php

class Candidato {

    public $idCandidato;
    public $nome;
    public $cpf;
    public $apto;
    public $partido;
    public $eleicoes;
    public $estado;
    public $cargo;

    function getIdCandidato() {
        return $this->idCandidato;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getApto() {
        return $this->apto;
    }

    function setIdCandidato($idCandidato) {
        $this->idCandidato = $idCandidato;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setApto($apto) {
        $this->apto = $apto;
    }

}

?>