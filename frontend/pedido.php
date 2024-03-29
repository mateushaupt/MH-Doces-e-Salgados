<?php
session_start();
error_reporting(0);
include_once(__DIR__ . '../../backend/banco.php');

$banco = new Banco;
$conn = $banco->conectar();
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
                    <a class="nav-link" href="#">Fazer Pedido</a>
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

    <!--  cadastro de produto section  -->
    <div class="container-fluid text-center text-light has-height-lg middle-items" id="cadastro">
        <form method="post" name="registration" action="../backend/inserir.php">
            <input type="hidden" value="2" name="registro" id="registro">
            <input type="hidden" value="<?php echo htmlentities($_SESSION["usuario_id"]) ?>" name="usuario_id">
            <input type="hidden" value="0" name="entregue">
            <div class="mt-5">
                <h2 class="section-title mb-5">Fazer Pedido</h2>
                <div class="container-fluid text-center text-light">
                    <h2 class="mb-3 mt-5">Nome do Cliente</h2>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-6 col-md-4 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-4 col-xs-12 my-2">
                        <input type="text" id="nome" name="nome" class="form-control form-control-lg custom-form-control" placeholder="Nome" value="<?php echo htmlentities($_POST['nome']) ?>">
                    </div>
                    <div class="col-sm-6 col-md-4 col-xs-12 my-2">
                    </div>
                </div>
                <div class="container-fluid text-center text-light">
                    <h2 class="mb-3 mt-5">Hora e Dia</h2>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="time" id="hora" name="hora" class="form-control form-control-lg custom-form-control" placeholder="12:12" value="<?php echo htmlentities($_POST['hora']) ?>">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="date" id="dia" name="dia" class="form-control form-control-lg custom-form-control" placeholder="12/12/2012" value="<?php echo htmlentities($_POST['data']) ?>">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                </div>
                <div class="container-fluid text-center text-light">
                    <h2 class="mb-3 mt-5">Doces</h2>
                </div>
                <div class="container-fluid text-center text-light middle-items" id="tableProduto">
                    <table id="datatablesSimple" class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $produtos = $banco->buscaProduto();
                            for ($d = 0; $d < count($produtos); $d++) {
                                if ($produtos[$d]["tipo"] == 'Doce') {
                                    echo '
                                        <tr>
                                            <td>' . htmlentities($produtos[$d]["nome"]) . '</td>
                                            <td>R$ ' . htmlentities(number_format($produtos[$d]["valor"], 2, ',', '.')) . '</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <input type="number" class="form-control" name="produtos[' . htmlentities($produtos[$d]["produto_id"]) . '][]" id="' . htmlentities($produtos[$d]["produto_id"]) . '">
                                                </div>
                                            </td>
                                        </tr>
                                    ';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="container-fluid text-center text-light">
                    <h2 class="mb-3 mt-5">Salgados</h2>
                </div>
                <div class="container-fluid text-center text-light middle-items" id="tableProduto">
                    <table id="datatablesSimple" class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($s = 0; $s < count($produtos); $s++) {
                                if ($produtos[$s]["tipo"] == 'Salgado') {
                                    echo '
                                        <tr>
                                            <td>' . htmlentities($produtos[$s]["nome"]) . '</td>
                                            <td>R$ ' . htmlentities(number_format($produtos[$s]["valor"], 2, ',', '.')) . '</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <input type="number" class="form-control" name="produtos[' . htmlentities($produtos[$s]["produto_id"]) . '][]" id="' . htmlentities($produtos[$s]["produto_id"]) . '">
                                                </div>
                                            </td>
                                        </tr>
                                    ';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="container-fluid text-center text-light">
                    <h2 class="mb-3 mt-5">Tortas</h2>
                </div>
                <div class="container-fluid text-center text-light middle-items" id="tableProduto">
                    <table id="datatablesSimple" class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($b = 0; $b < count($produtos); $b++) {
                                if ($produtos[$b]["tipo"] == 'Torta') {
                                    echo '
                                        <tr>
                                            <td>' . htmlentities($produtos[$b]["nome"]) . '</td>
                                            <td>R$ ' . htmlentities(number_format($produtos[$b]["valor"], 2, ',', '.')) . '</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                        <input type="number" class="form-control" step="any" name="produtos[' . htmlentities($produtos[$b]["produto_id"]) . '][]" id="' . htmlentities($produtos[$b]["produto_id"]) . '">
                                                </div>
                                            </td>
                                        </tr>
                                    ';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="container-fluid text-center text-light">
                    <h2 class="mb-3 mt-5">Outros</h2>
                </div>
                <div class="container-fluid text-center text-light middle-items" id="tableProduto">
                    <table id="datatablesSimple" class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($b = 0; $b < count($produtos); $b++) {
                                if ($produtos[$b]["tipo"] == 'Outros') {
                                    echo '
                                        <tr>
                                            <td>' . htmlentities($produtos[$b]["nome"]) . '</td>
                                            <td>R$ ' . htmlentities(number_format($produtos[$b]["valor"], 2, ',', '.')) . '</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                        <input type="number" class="form-control" name="produtos[' . htmlentities($produtos[$b]["produto_id"]) . '][]" id="' . htmlentities($produtos[$b]["produto_id"]) . '">
                                                </div>
                                            </td>
                                        </tr>
                                    ';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <h2 class="mb-3 mt-5">Local</h2>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="text" id="cidade" name="cidade" class="form-control form-control-lg custom-form-control" placeholder="Cidade">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="text" id="bairro" name="bairro" class="form-control form-control-lg custom-form-control" placeholder="Bairro">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="text" id="rua" name="rua" class="form-control form-control-lg custom-form-control" placeholder="Rua">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                </div>
                <div class="mb-2">
                    <a href="initialPage.php" class="btn btn-lg btn-primary col-md-2" id="rounded-btn">Cancelar</a>
                    <button type="submit" name="submit" class="btn btn-lg btn-primary col-md-2" id="rounded-btn">Pedir</button>
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