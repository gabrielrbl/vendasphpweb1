<?php

class ItensVenda {
    private $id;
    private $idvenda;
    private $idproduto;
    private $quantidade;
    private $valorunitario;
    
    public function __construct($id, $idvenda, $idproduto, $quantidade, $valorunitario) {
        $this->id = $id;
        $this->idvenda = $idvenda;
        $this->idproduto = $idproduto;
        $this->quantidade = $quantidade;
        $this->valorunitario = $valorunitario;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getidvenda() {
        return $this->idvenda;
    }

    public function setidvenda($idvenda) {
        $this->idvenda = $idvenda;
    }

    public function getidproduto() {
        return $this->idproduto;
    }

    public function setidproduto($idproduto) {
        $this->idproduto = $idproduto;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getValorunitario() {
        return $this->valorunitario;
    }

    public function setValorunitario($valorunitario) {
        $this->valorunitario = $valorunitario;
    }
}