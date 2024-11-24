<?php

class Lutador {
    private $id;
    private $nome;
    private $localidade;
    private Organizacao $organizacao;

    public function __construct($id, $nome, $localidade, Organizacao $organizacao)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->localidade = $localidade;
        $this->organizacao = $organizacao;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getLocalidade() {
        return $this->localidade;
    }

    public function setLocalidade($localidade) {
        $this->localidade = $localidade;
    }

    public function getOrganizacao() {
        return $this->organizacao;
    }

    public function setOrganizacao(Organizacao $organizacao) {
        $this->organizacao = $organizacao;
    }
}