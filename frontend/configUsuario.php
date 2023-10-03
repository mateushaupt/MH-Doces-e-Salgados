<?php
session_start();
error_reporting(0);
include_once(__DIR__ . '../../backend/banco.php');

$banco = new Banco;
$conn = $banco->conectar();

$stmt = $conn->prepare('SELECT nome, email, telefone FROM usuario WHERE usuario_id = :usuario_id');
$stmt->execute(
    [
        ':usuario_id' => $_SESSION["usuario_id"]
    ]
);
$ret = $stmt->fetch();


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

    <!--  edicao de usuario section  -->
    <div class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items" id="cadastro">
        <form method="post" name="registration" action="../backend/alterar.php">
            <input type="hidden" value="4" name="registro" id="registro">
            <input type="hidden" value="<?=$_SESSION["usuario_id"]?>" name="usuario_id" id="usuario_id">
            <div class="">
                <h2 class="section-title mb-5 mt-5">Editar Perfil</h2>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="text" id="nome" name="nome" class="form-control form-control-lg custom-form-control" placeholder="Nome" value="<?php echo htmlentities($ret['nome']) ?>">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="text" id="email" name="email" class="form-control form-control-lg custom-form-control" placeholder="Email" value="<?php echo htmlentities($ret['email']) ?>">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="tel" id="telefone" name="telefone" class="form-control form-control-lg custom-form-control" placeholder="Telefone" value="<?php echo htmlentities($ret['telefone']) ?>">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                </div>
                <div class="mb-2">
                    <a href="initialPage.php" class="btn btn-lg btn-primary col-md-2" id="rounded-btn">Cancelar</a>
                    <button type="submit" name="submit" class="btn btn-lg btn-primary col-md-2" id="rounded-btn">Salvar</button>
                </div>
            </div>
        </form>
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