<?php
    require_once '../../controller/ClientesController.php';
    $clientes = new ClientesController();
?>
<!doctype html>
<html class="no-js" lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de vendas | Cadastrar cliente</title>
    <link rel="stylesheet" href="../../../public/vendor/css/foundation.css">
</head>

<body>
    <header>
        <div class="top-bar">
            <div class="top-bar-left">
                <ul class="menu">
                    <li><a href="../../../index.php">Início</a></li>
                    <li><a href="./index.php">Clientes</a></li>
                    <li><a href="../produto/index.php">Produtos</a></li>
                    <li><a href="../venda/index.php">Vendas</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="callout large">
        <div class="row column text-center">
            <h1>Cadastrar cliente</h1>
        </div>
    </div>

    <div class="row column">
        <?php
            if($_POST){
                $cliente = new ClientesController();
                $cliente->setNome($_POST['nome']);
                $cliente->setCpf($_POST['cpf']);
                $cliente->setTelefone($_POST['telefone']);

                try {
                    $cliente->insert($cliente->getNome(), $cliente->getCpf(), $cliente->getTelefone());
                    echo
                        '<div class="success callout">
                            <h5>Cliente cadastrado</h5>
                            <p>Cliente cadastrado com sucesso!.</p>
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
                        <label>Nome Completo
                            <input type="text" name="nome" placeholder="Informe o nome completo">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>CPF
                            <input type="text" name="cpf" placeholder="Informe o CPF">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Telefone
                            <input type="text" name="telefone" placeholder="Informe o telefone">
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