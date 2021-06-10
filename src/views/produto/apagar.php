<?php

require_once '../controller/ProdutosController.php';
if (!$_GET) header('Location: ./index.php');

$produto = new ProdutosController();
$produto->setId($_GET['id']);

try {
    $produto->delete($produto->getId());
    header('Location: ./index.php');
} catch (PDOException $err) {
    $err->getMessage();
}
