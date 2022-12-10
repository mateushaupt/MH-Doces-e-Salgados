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
    <div class="container-fluid text-center text-light  middle-items" id="tableProduto">
        <h1 class="mb-3 mt-5">Meus Pedidos</h1>
        <div class="mb-3 mt-5">

            <a href="pedido.php" class="btn btn-lg btn-primary mb-3 mt-7">Fazer Pedido</a>
            <a href="initialPage.php" class="btn btn-lg btn-primary mb-3 mt-7">Voltar</a>
        </div>
    </div>
    <div class="container-fluid text-center middle-items">
    
                <?php
                $pedidos = $banco->buscaPedido($_SESSION["usuario_id"]);
                for ($p = 0; $p < count($pedidos); $p++) {
                ?>
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header">
                            <h3>Pedido #<?php echo htmlentities($pedidos[$p]["pedido_id"]); ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row mb-4 justify-content-md-center">
                                    <div class="col-auto">
                                        Dia e Hora: <?php echo htmlentities($pedidos[$p]["dia"]); ?>, <?php echo htmlentities($pedidos[$p]["hora"]); ?>
                                    </div>
                                </div>
                                <div class="row mb-4 justify-content-md-center">
                                    <div class="col-auto">
                                        Valor Total: R$ <?php echo htmlentities($pedidos[$p]["valor"]); ?>
                                    </div>
                                </div>
                                <div class="row mb-4 justify-content-md-center">
                                    <div class="col-auto">
                                        Endereço: <?php echo htmlentities($pedidos[$p]["endereco"]); ?>
                                    </div>
                                </div>
                                <div class="row mb-4 justify-content-md-center">
                                <form action="../backend/excluir.php" method="post">
                                    <input type="hidden" value="3" name="registro" id="registro">
                                    <input type="hidden" value="<?php echo htmlentities($pedidos[$p]["pedido_id"]); ?>" name="pedido_id">
                                    <button type="submit" name="submit" class="btn btn-primary mr-1" style="float: right;">Cancelar Pedido</button>
                                </form>
                                <button type="button" class="btn btn-primary" style="float: right;">Visualizar Pedido</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
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