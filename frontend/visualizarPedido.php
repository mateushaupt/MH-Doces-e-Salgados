<?php
session_start();
include_once(__DIR__ . '..\..\backend\banco.php');
$banco = new Banco;

$pesquisa = 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with FoodHut landing page.">
    <meta name="author" content="Devcrud">
    <title>FoodHut | Free Bootstrap 4.3.x template</title>

    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">

    <link rel="stylesheet" href="assets/vendors/animate/animate.css">

    <!-- Bootstrap + FoodHut main styles -->
    <link rel="stylesheet" href="assets/css/foodhut.css">

    <script type="text/javascript" src="assets/js/foodhut.js"></script>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- Navbar -->
    <nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="initialPage.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="initialPage.php">Sobre Nós</a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link" href="#gallary">Gallary</a>
                </li>
            -->
                <li class="nav-item">
                    <a class="nav-link" href="pedido.php">Fazer Pedido</a>
                </li>
            </ul>
            <a class="navbar-brand m-auto" href="#">
                <!-- <img src="assets/imgs/logo.svg" class="brand-img" alt=""> -->
                <span class="brand-txt">MH</span>
            </a>
            <ul class="navbar-nav">
                <!--
                <li class="nav-item">
                    <a class="nav-link" href="#blog">Blog<span class="sr-only">(current)</span></a>
                </li>
            -->
                <li class="nav-item">
                    <a class="nav-link" href="initialPage.php">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="initialPage.php">Contate-nos</a>
                </li>
                <?php
                if ($banco->autenticaConexao($_SESSION["usuario_id"])) {
                    echo '
                        <li class="nav-item dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Olá, Seja Bem-Vindo
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        ';
                    if ($banco->autentica($_SESSION["usuario_id"])) {
                        echo '<a class="dropdown-item" href="produto.php">Produtos</a>
                        <a class="dropdown-item" href="estoque.php">Estoque</a>
                        <a class="dropdown-item" href="gerenciarPedidos.php">Gerenciar Pedidos</a>';
                    }
                    echo
                    '
                        <a class="dropdown-item" href="pedidos.php">Meus Pedidos</a>
                        <a class="dropdown-item" href="configUsuario.php">Configurações</a>
                        <a class="dropdown-item" href="..\backend\logout.php">Sair</a>
                        </div>
                        </li>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <!--  visualizar produto section  -->
    <div class="container-fluid text-center text-light  middle-items mb-5 mt-5" id="tableProduto">
        <h1>Visualizar Pedido</h1>
    <?php 
        $pedido = $banco->buscaVisuPedido($_POST['pedido_id']);
        ?>
        <div class="card text-white bg-secondary mb-3 mt-3">
                        <div class="card-header">
                            <h3>Pedido #<?=htmlentities($pedido["pedido_id"])?></h3>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row mb-4 justify-content-md-center">
                                    <div class="col-auto">
                                        Dia e Hora: <?=htmlentities($pedido["dia"])?>, <?=htmlentities($pedido["hora"])?>
                                    </div>
                                </div>
                                <div class="row mb-4 justify-content-md-center">
                                    <div class="col-auto">
                                        Valor Total: R$ <?=htmlentities(number_format($pedido["valor"], 2, ',', '.'))?>
                                    </div>
                                </div>
                                <div class="row mb-4 justify-content-md-center">
                                    <div class="col-auto">
                                        Endereço: <?=htmlentities($pedido["endereco"])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
        <div class="container-fluid text-center text-light middle-items mb-3" id="tableProduto">
        <table id="datatablesSimple" class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>Produtos</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>              
            <?php 
            $produtos = $banco->buscaVisuTwoPedido($_POST['pedido_id']);
            for ($p = 0; $p < count($produtos); $p++) { 
                    echo '
                    <tr>
                        <td>' . htmlentities($produtos[$p]["nome"]) . '</td>
                        <td>' . htmlentities($produtos[$p]["quantidade"]) . '</td>
                    </tr>
                ';
                } 
                ?>
            </tbody>
        </table>
        <?php
        if ($banco->autentica($_SESSION["usuario_id"])) {
                        echo '
                        <a href="gerenciarPedidos.php" class="btn btn-lg btn-primary mt-3 mb-3" id="rounded-btn">Voltar</a>';
                    } else {echo '<a href="pedidos.php" class="btn btn-lg btn-primary mt-3 mb-3" id="rounded-btn">Voltar</a>';}
        ?>
        
    </div>

    <!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap affix -->
    <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- wow.js -->
    <script src="assets/vendors/wow/wow.js"></script>

    <!-- FoodHut js -->
    <script src="assets/js/foodhut.js"></script>

</body>

</html>
