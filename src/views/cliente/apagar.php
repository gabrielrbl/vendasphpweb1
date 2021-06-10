<?php

require_once '../../controller/ClientesController.php';
if (!$_GET) header('Location: ./index.php');

$cliente = new ClientesController();
$cliente->setId($_GET['id']);

try {
    $cliente->delete($cliente->getId());
    header('Location: ./index.php');
} catch (PDOException $err) {
    $err->getMessage();
}
