<?php
session_start();
error_reporting(0);
include_once(__DIR__ . '../../backend/banco.php');

$banco = new Banco;
$conn = $banco->conectar();

$stmt = $conn->prepare('SELECT nome, valor, tipo, estocavel FROM produto WHERE produto_id = :produto_id');
$stmt->execute(
    [
        ':produto_id' => $_POST['produto_id']
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

    <!--  edicao de produto section  -->
    <div class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items" id="cadastro">
        <form method="post" name="registration" action="../backend/alterar.php">
            <input type="hidden" value="1" name="registro" id="registro">
            <input type="hidden" value="<?=$_POST['produto_id']?>" name="produto_id" id="produto_id">
            <div class="">
                <h2 class="section-title mb-5 mt-5">Editar Produto</h2>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="text" id="nomeProduto" name="nomeProduto" class="form-control form-control-lg custom-form-control" placeholder="Nome do Produto" value="<?php echo htmlentities($ret['nome']) ?>">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="text" id="valorProduto" name="valorProduto" onchange="formatValue(this)" class="form-control form-control-lg custom-form-control" placeholder="Valor" value="<?php echo htmlentities(number_format($ret["valor"], 2, ',', '.')) ?>">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <select class="form-control form-control-lg custom-form-control" id="tipoProduto" name="tipoProduto">
                            <option value="" disabled selected>Tipo</option>
                            <option value="Doce" <?php if ($ret['tipo'] == 'Doce') print('selected') ?>>Doce</option>
                            <option value="Salgado" <?php if ($ret['tipo'] == 'Salgado') print('selected') ?>>Salgado</option>
                            <option value="Bolo" <?php if ($ret['tipo'] == 'Torta') print('selected') ?>>Torta</option>
                            <option value="Bolo" <?php if ($ret['tipo'] == 'Outros') print('selected') ?>>Outros</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <select class="form-control form-control-lg custom-form-control" id="estocavel" name="estocavel">
                            <option value="" disabled selected>É estocável</option>
                            <option value="1" <?php if ($ret['estocavel'] == '1') print('selected') ?>>Sim</option>
                            <option value="0" <?php if ($ret['estocavel'] == '0') print('selected') ?>>Não</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                </div>
                <div class="mb-2">
                    <a href="produto.php" class="btn btn-lg btn-primary col-md-2" id="rounded-btn">Cancelar</a>
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