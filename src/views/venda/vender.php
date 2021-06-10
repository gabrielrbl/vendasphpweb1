<?php
    require_once '../../controller/ClientesController.php';
    require_once '../../controller/ProdutosController.php';
    $clientes = new ClientesController();
    $produtos = new ProdutosController();
?>
<!doctype html>
<html class="no-js" lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de vendas | Realizar venda</title>
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
            <h1>Realizar venda</h1>
        </div>
    </div>

    <div class="row column">        
        <a href="#" id="add" class="primary button float-right">Novo produto</a>

        <form action="./finalizar.php" method="POST">
            <div class="grid-container">
                <div class="grid-x grid-padding-x" id="produtos">
                    <div class="medium-12 cell">
                        <label>Cliente
                            <select name="idcliente" required>
                                <option value="" selected disabled>Selecione um cliente</option>
                                <?php
                                    foreach ($clientes->findAll() as $obj) { ?>
                                        <option value="<?= $obj->getId() ?>"><?= $obj->getNome() ?></option>
                                <?php } ?>
                            </select>
                        </label>
                    </div>
                    <div class="input medium-8 cell" id="produto">
                        <label>Selecionar produto
                            <select name="idproduto[]" required>
                                <option value="" selected disabled>Selecione um produto</option>
                                    <?php
                                        foreach ($produtos->findAll() as $obj) { ?>
                                            <option value="<?= $obj->getId() ?>"><?= $obj->getNome() . ' - ' . $obj->getValor() ?></option> <?php
                                        }
                                    ?>
                            </select>
                        </label>
                    </div>
                    <div class="input medium-4 cell" id="quantidade">
                        <label>Quantidade
                            <input type="number" min="1" name="quantidade[]" required>
                        </label>
                    </div>
                    <div class="input medium-2 cell" style="display: none;" id="valor">
                        <label>Valor unidade
                            <input type="hidden" name="valor[]" disabled>
                        </label>
                    </div>
                </div>
                    
                <input type="submit" class="button" value="Finalizar">
            </div>
        </form>
    </div>

    <div class="row expanded">
        <div class="medium-6 columns">
            <ul class="menu align-right">
                <li class="menu-text">Copyright © 2021 Gabriel Lobo</li>
            </ul>
        </div>
    </div>

    <script>
        document.getElementById("add").addEventListener("click", () => {
            const produto = document.getElementById("produto").cloneNode(true);
            const quantidade = document.getElementById("quantidade").cloneNode(true);
            const valor = document.getElementById("valor").cloneNode(true);

            document.getElementById("produtos").append(produto);
            document.getElementById("produtos").append(quantidade);
            document.getElementById("produtos").append(valor);
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../public/vendor/js/foundation.js"></script>
    <script>
        $(document).foundation();
    </script>
  </body>
</html>