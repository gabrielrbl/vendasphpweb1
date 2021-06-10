<?php

require_once '../../model/Produto.php';
require_once '../../model/Database.php';

class ProdutosController extends Produto {
    protected $tabela = 'produto';

    public function __construct() { }

    public function findOne($id) {
        $query = "SELECT * FROM $this->tabela WHERE id = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $produto = new Produto(null, null, null, null);
            $produto->setId($obj->id);
            $produto->setNome($obj->nome);
            $produto->setValor($obj->valor);
            $produto->setQuantidade($obj->quantidade);
        }
        return $produto;
    }

    public function findAll() {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $produtos = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $produtos,
                new Produto($obj->id, $obj->nome, $obj->valor, $obj->quantidade)
            );
        }
        return $produtos;
    }

    public function insert($nome, $valor, $quantidade) {
        $query = "INSERT INTO $this->tabela (nome, valor, quantidade) VALUES (:nome, :valor, :quantidade)";
        $stm = Database::prepare($query);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':valor', $valor);
        $stm->bindParam(':quantidade', $quantidade);
        return $stm->execute();
    }

    public function update($id) {
        $query = "UPDATE $this->tabela SET nome = :nome, valor = :valor, quantidade = :quantidade WHERE id = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->bindValue(':nome', $this->getNome());
        $stm->bindValue(':valor', $this->getValor());
        $stm->bindValue(':quantidade', $this->getQuantidade());
        return $stm->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM $this->tabela WHERE id = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        return $stm->execute();
    }
}
