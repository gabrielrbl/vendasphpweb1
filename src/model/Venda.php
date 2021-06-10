<?php

class Venda {
    private $id;
    private $idcliente;
    private $valortotal;
    
    public function __construct($id, $idcliente, $valortotal) {
        $this->id = $id;
        $this->idcliente = $idcliente;
        $this->valortotal = $valortotal;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdcliente() {
        return $this->idcliente;
    }

    public function setIdcliente($idcliente) {
        $this->idcliente = $idcliente;
    }

    public function getValortotal() {
        return $this->valortotal;
    }

    public function setValortotal($valortotal) {
        $this->valortotal = $valortotal;
    }
}