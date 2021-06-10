<?php

require_once '../../model/ItensVenda.php';
require_once '../../model/Database.php';

class ItensVendaController extends ItensVenda {
    protected $tabela = 'itensvenda';

    public function __construct() { }

    public function insert($idvenda, $idproduto, $quantidade, $valorunitario) {
        $query = "INSERT INTO $this->tabela (idvenda, idproduto, quantidade, valorunitario) VALUES (:idvenda, :idproduto, :quantidade, :valorunitario)";
        $stm = Database::prepare($query);
        $stm->bindParam(':idvenda', $idvenda);
        $stm->bindParam(':idproduto', $idproduto);
        $stm->bindParam(':quantidade', $quantidade);
        $stm->bindParam(':valorunitario', $valorunitario);
        return $stm->execute();
    }

    public function findAllByIdVenda($id) {
        $query = "SELECT * FROM $this->tabela WHERE idvenda = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        $itensvenda = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $itensvenda,
                new ItensVenda($obj->id, $obj->idvenda, $obj->idproduto, $obj->quantidade, $obj->valorunitario)
            );
        }
        return $itensvenda;
    }

    public function delete($id) {
        $query = "DELETE FROM $this->tabela WHERE id = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        return $stm->execute();
    }
}