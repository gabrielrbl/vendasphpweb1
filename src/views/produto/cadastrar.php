<?php
    require_once '../../controller/ProdutosController.php';
    $produto = new ProdutosController();
?>
<!doctype html>
<html class="no-js" lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de vendas | Cadastrar produto</title>
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
            <h1>Cadastrar produto</h1>
        </div>
    </div>

    <div class="row column">
        <?php
            if($_POST){
                $produto->setNome($_POST['nome']);
                $produto->setValor($_POST['valor']);
                $produto->setQuantidade($_POST['quantidade']);

                try {
                    $produto->insert($produto->getNome(), $produto->getValor(), $produto->getQuantidade());
                    echo
                        '<div class="success callout">
                            <h5>Produto cadastrado</h5>
                            <p>Produto cadastrado com sucesso!.</p>
                        </div>';
                } catch (PDOException $err) {
                    $err->getMessage();
                }
            }
        ?>
        <form action="" method="POST">
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="medium-12 cell">
                        <label>Nome
                            <input type="text" name="nome" placeholder="Informe o nome">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Valor
                            <input type="text" name="valor" placeholder="Informe o valor">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Quantidade
                            <input type="text" name="quantidade" placeholder="Informe a quantidade">
                        </label>
                    </div>
                </div>

                <input type="submit" class="button" value="Cadastrar">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../public/vendor/js/foundation.js"></script>
    <script>
        $(document).foundation();
    </script>
  </body>
</html>