<?php

require_once '../../model/Cliente.php';
require_once '../../model/Database.php';

class ClientesController extends Cliente {
    protected $tabela = 'cliente';

    public function __construct() { }

    public function findOne($id) {
        $query = "SELECT * FROM $this->tabela WHERE id = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $cliente = new Cliente(null, null, null, null);
            $cliente->setId($obj->id);
            $cliente->setNome($obj->nome);
            $cliente->setCpf($obj->cpf);
            $cliente->setTelefone($obj->telefone);
        }
        return $cliente;
    }

    public function findAll() {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $clientes = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $clientes,
                new Cliente($obj->id, $obj->nome, $obj->cpf, $obj->telefone)
            );
        }
        return $clientes;
    }

    public function insert($nome, $cpf, $telefone) {
        $query = "INSERT INTO $this->tabela (nome, cpf, telefone) VALUES (:nome, :cpf, :telefone)";
        $stm = Database::prepare($query);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':cpf', $cpf);
        $stm->bindParam(':telefone', $telefone);
        return $stm->execute();
    }

    public function update($id) {
        $query = "UPDATE $this->tabela SET nome = :nome, cpf = :cpf, telefone = :telefone WHERE id = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->bindValue(':nome', $this->getNome());
        $stm->bindValue(':cpf', $this->getCpf());
        $stm->bindValue(':telefone', $this->getTelefone());
        return $stm->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM $this->tabela WHERE id = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        return $stm->execute();
    }
}
