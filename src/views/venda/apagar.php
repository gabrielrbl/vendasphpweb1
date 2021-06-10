<?php

require_once '../../controller/VendasController.php';
if (!$_GET) header('Location: ./index.php');

$venda = new VendasController();
$venda->setId($_GET['id']);

try {
    $venda->delete($venda->getId());
    header('Location: ./index.php');
} catch (PDOException $err) {
    echo $err->getMessage();
}
