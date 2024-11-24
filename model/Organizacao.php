<?php

class Organizacao {
    private $id;
    private $nome;
    private $localidade;

    public function __construct($id, $nome, $localidade) {
        $this->id = $id;
        $this->nome = $nome;
        $this->localidade = $localidade;
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
}