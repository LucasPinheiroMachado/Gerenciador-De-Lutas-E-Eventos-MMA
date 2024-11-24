<?php 

class Evento {
    private $id;
    private $nome;
    private $data;
    private Organizacao $organizacao;

    public function __construct($id, $nome, $data, Organizacao $organizacao)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->data = $data;
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

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getOrganizacao() {
        return $this->organizacao;
    }

    public function setOrganizacao(Organizacao $organizacao) {
        $this->organizacao = $organizacao;
    }
}