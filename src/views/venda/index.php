<?php
    require_once '../../controller/VendasController.php';
    require_once '../../controller/ClientesController.php';
    $vendas = new VendasController();
    $clientes = new ClientesController();
?>
<!doctype html>
<html class="no-js" lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de vendas | Vendas</title>
    <link rel="stylesheet" href="../../../public/vendor/css/foundation.css">
</head>

<body>
    <header>
        <div class="top-bar">
            <div class="top-bar-left">
                <ul class="menu">
                    <li><a href="../../../index.php">Início</a></li>
                    <li><a href="../cliente/index.php">Clientes</a></li>
                    <li><a href="../produto/index.php">Produtos</a></li>
                    <li><a href="./index.php">Vendas</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="callout large">
        <div class="row column text-center">
            <h1>Vendas</h1>
        </div>
    </div>

    <div class="row column">
        <a href="./vender.php" class="primary button float-right">Vender</a>

        <table class="responsive-card-table unstriped">
            <thead>
                <th>#</th>
                <th>Cliente</th>
                <th>Valor total</th>
                <th>Ações</th>
            </thead>
            <tbody>
                <?php
                    foreach ($vendas->findAll() as $obj) { ?>
                        <tr>
                            <td><?= $obj->getId() ?> </td>
                            <td><?= $clientes->findOne($obj->getIdcliente())->getNome() ?> </td>
                            <td>R$ <?= number_format($obj->getValortotal(), 2, ',', '') ?> </td>
                            <td>
                                <div class="button-group clear">
                                    <a class="secondary button" href="#">Visualizar</a>
                                    <a class="success button" href="./editar.php?id=<?= $obj->getId() ?>">Editar</a>
                                    <a class="alert button" href="#" onclick="deletar('<?= $obj->getId() ?>')">Apagar</a>
                                </div>
                            </td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>

    <div class="row expanded">
        <div class="medium-6 columns">
        <ul class="menu align-right">
            <li class="menu-text">Copyright © 2021 Gabriel Lobo</li>
        </ul>
        </div>
    </div>

    <script>
        function deletar(id){
            if(confirm(`Deseja remover a venda "${id}"?`)){
                window.location.href = `./apagar.php?id=${id}`
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../public/vendor/js/foundation.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>