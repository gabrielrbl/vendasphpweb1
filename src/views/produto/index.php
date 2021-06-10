<?php
    require_once '../../controller/ProdutosController.php';
    $produtos = new ProdutosController();
?>
<!doctype html>
<html class="no-js" lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de vendas | Produtos</title>
    <link rel="stylesheet" href="../../../public/vendor/css/foundation.css">
</head>

<body>
    <header>
        <div class="top-bar">
            <div class="top-bar-left">
                <ul class="menu">
                    <li><a href="../../../index.php">Início</a></li>
                    <li><a href="../cliente/index.php">Clientes</a></li>
                    <li><a href="./index.php">Produtos</a></li>
                    <li><a href="../venda/index.php">Vendas</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="callout large">
        <div class="row column text-center">
            <h1>Produtos</h1>
        </div>
    </div>

    <div class="row column">
        <a href="./cadastrar.php" class="primary button float-right">Cadastrar produto</a>

        <table class="responsive-card-table unstriped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Estoque</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($produtos->findAll() as $obj) { ?>
                    <tr>
                        <td><?= $obj->getId() ?></td>
                        <td><?= $obj->getNome() ?></td>
                        <td>R$<?= number_format($obj->getValor(), 2, ',', '') ?></td> 
                        <td><?= $obj->getQuantidade() ?></td> 
                        <td>
                            <div class="button-group clear">                                
                                <a class="success button" href="./editar.php?id=<?= $obj->getId() ?>">Editar</a>
                                <a class="alert button" href="#" onclick="deletar('<?= $obj->getId() ?>', '<?= $obj->getNome() ?>')">Apagar</a>
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
        function deletar(id, nome){
            if(confirm(`Tem certeza que deseja remover o produto "${nome}"?`)){
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