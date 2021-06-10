<?php
    if(!$_GET) header('Location: ./index.php');
    require_once '../../controller/ProdutosController.php';

    $id = $_GET['id'];
    $produto = new ProdutosController();
    $produto->setId($id);
    $produto->setNome($produto->findOne($id)->getNome());
    $produto->setValor($produto->findOne($id)->getValor());
    $produto->setQuantidade($produto->findOne($id)->getQuantidade());
?>
<!doctype html>
<html class="no-js" lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de vendas | Editar produto</title>
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
            <h1>Editar produto</h1>
        </div>
    </div>

    <div class="row column">
        <?php
            if($_POST){
                $produto->setNome($_POST['nome']);
                $produto->setValor($_POST['valor']);
                $produto->setQuantidade($_POST['quantidade']);

                try {
                    $produto->update($id);
                    echo
                        '<div class="success callout">
                            <h5>Produto atualizado</h5>
                            <p>Produto atualizado com sucesso!.</p>
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
                            <input type="text" name="nome" value="<?= $produto->getNome() ?>" placeholder="Informe o nome">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Valor
                            <input type="text" name="valor" value="<?= $produto->getValor() ?>" placeholder="Informe o valor">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Quantidade
                            <input type="text" name="quantidade" value="<?= $produto->getQuantidade() ?>" placeholder="Informe a quantidade">
                        </label>
                    </div>
                </div>

                <input type="submit" class="button" value="Atualizar">
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