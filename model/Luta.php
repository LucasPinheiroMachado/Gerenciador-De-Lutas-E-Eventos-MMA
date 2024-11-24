<?php

class Luta {
    private $id;
    private Lutador $lutador1;
    private Lutador $lutador2;
    private Evento $evento;

    public function __construct($id, Lutador $lutador1, Lutador $lutador2, Evento $evento)
    {
        $this->id = $id;
        $this->lutador1 = $lutador1;
        $this->lutador2 = $lutador2;
        $this->evento = $evento;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLutador1() {
        return $this->lutador1;
    }

    public function setLutador1(Lutador $lutador1) {
        $this->lutador1 = $lutador1;
    }

    public function getLutador2() {
        return $this->lutador2;
    }

    public function setLutador2(Lutador $lutador2) {
        $this->lutador2 = $lutador2;
    }

    public function getEvento() {
        return $this->evento;
    }

    public function setEvento(Evento $evento) {
        $this->evento = $evento;
    }
}