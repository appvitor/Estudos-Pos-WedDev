<?php

class Bem {

    public $idBem;
    public $descricao;
    public $valor;
//---------------------------------------------------------------------
    public $tipo;
    public $candidato;
//----------------------------------------------------------------------
    function getIdEstado() {
        return $this->idEstado;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getvalor() {
        return $this->valor;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getCandidato() {
        return $this->candidato;
    }
//------------------------------------------------------------------------
    function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setCandidato($candidato) {
        $this->candidato = $candidato;
    }

}
