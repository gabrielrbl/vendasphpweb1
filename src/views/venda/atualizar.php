<?php

if(!$_GET || !$_POST) header('Location: ./index.php');

require_once '../../controller/ProdutosController.php';
require_once '../../controller/ItensVendaController.php';

$produto = new ProdutosController();
$itensvenda = new itensvendaController();

$idcliente = intval($_POST['idcliente']);
$idprodutoArray = $_POST['idproduto'];
$quantidadeArray = $_POST['quantidade'];
$idvenda = $_GET['id'];
$valorArray = array();

foreach ($idprodutoArray as $id) {
    array_push($valorArray, $produto->findOne($id)->getValor());
}

$itensvenda->setIdvenda($idvenda);
$itensvenda->setIdproduto($idprodutoArray);
$itensvenda->setQuantidade($quantidadeArray);
$itensvenda->setValorunitario($valorArray);

try {
    $itensvenda->delete($itensvenda->getIdvenda());

    for ($i = 0; $i < count($idprodutoArray); $i++) { 
        $itensvenda->insert(
            $itensvenda->getIdvenda(), 
            $itensvenda->getIdproduto()[$i], 
            $itensvenda->getQuantidade()[$i], 
            $itensvenda->getValorunitario()[$i]
        );
    }
    header('Location: ./index.php');

} catch (PDOException $err) {
    echo $err->getMessage();
}