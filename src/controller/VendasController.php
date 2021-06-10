<?php

require_once '../../model/Venda.php';
require_once '../../model/Database.php';

class VendasController extends Venda {
    protected $tabela = 'venda';

    public function __construct() { }

    public function findOne($id) {
        $query = "SELECT * FROM $this->tabela WHERE id = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $venda = new Venda(null, null, null);
            $venda->setId($obj->id);
            $venda->setIdcliente($obj->idcliente);
            $venda->setValortotal($obj->valortotal);
        }
        return $venda;
    }

    public function findAll() {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $vendas = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $vendas,
                new Venda($obj->id, $obj->idcliente, $obj->valortotal)
            );
        }
        return $vendas;
    }

    public function findByIdCliente($idcliente) {
        $id = null;
        $query = "SELECT id FROM $this->tabela WHERE idcliente = :id AND valortotal = 0";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $idcliente, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $venda) {
            $id = $venda->id;
        }
        return $id;
    }

    public function insert($idcliente, $valortotal) {
        $query = "INSERT INTO $this->tabela (idcliente, valortotal) VALUES (:idcliente, :valortotal)";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcliente', $idcliente);
        $stm->bindParam(':valortotal', $valortotal);
        return $stm->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM $this->tabela WHERE id = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        return $stm->execute();
    }
}