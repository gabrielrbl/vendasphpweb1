<?php

require_once '../../controller/ProdutosController.php';
require_once '../../controller/VendasController.php';
require_once '../../controller/ItensVendaController.php';

$idcliente = intval($_POST['idcliente']);
$idprodutos = $_POST['idproduto'];
$quantidades = $_POST['quantidade'];
$valores = array();

$produto = new ProdutosController();
$venda = new VendasController();
$itensvenda = new ItensVendaController();

foreach ($idprodutos as $id) {
    array_push($valores, $produto->findOne($id)->getValor());
}

try {
    $venda->insert($idcliente, 0);
    $venda->setIdcliente($idcliente);
    $venda->setId($venda->findByIdCliente($idcliente));
    $itensvenda->setIdVenda($venda->getId());

    for ($i = 0; $i < count($idprodutos); $i++) { 
        $itensvenda->insert($venda->getId(), $idprodutos[$i], $quantidades[$i], $valores[$i]);
    }
    header('Location: ./index.php');

} catch (PDOException $err) {
    echo $err->getMessage();
}

