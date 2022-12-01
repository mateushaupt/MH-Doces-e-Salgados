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
    <?php session_start(); ?>
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
                    <a class="nav-link" href="#home">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Sobre Nós</a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link" href="#gallary">Gallary</a>
                </li>
            -->
                <li class="nav-item">
                    <a class="nav-link" href="#pedido">Fazer Pedido</a>
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
                    <a class="nav-link" href="#testmonial">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contate-nos</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary ml-xl-4" href="login.php">Entrar</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--  cadastro de usuario section  -->
    <div class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items" id="cadastro">
        <form method="post" name="registration" action="../backend/inserir.php">
        <input type="hidden" value="3" name="registro" id="registro">
            <div class="">
                <h2 class="section-title mb-5 mt-5">Fazer o Cadatro</h2>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="text" id="nome" name="nome" class="form-control form-control-lg custom-form-control" placeholder="Nome">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="text" id="emailCad" name="email" class="form-control form-control-lg custom-form-control" placeholder="Email">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="tel" id="telefone" name="telefone" class="form-control form-control-lg custom-form-control" placeholder="Telefone (00) 00000-0000">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="password" id="senhaCad" name="senha" class="form-control form-control-lg custom-form-control" placeholder="Senha">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="password" id="confirmasenha" name="confirmasenha" class="form-control form-control-lg custom-form-control" placeholder="Confirmar Senha">
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    </div>
                </div>
                <div class="mb-2">
                    <a href="index.php" class="btn btn-lg btn-primary col-md-2" id="rounded-btn">Cancelar</a>
                    <button type="submit" name="submit" class="btn btn-lg btn-primary col-md-2" id="rounded-btn">Cadastrar-se</button>
                </div>
                <a href="login.php" class="col-md-2">Já tem uma conta? Faça o Login!</a>
            </div>
        </form>
    </div>

    <!-- page footer  -->
    <div class="container-fluid bg-dark text-light has-height-md middle-items border-top text-center wow fadeIn">
        <div class="row">
            <div class="col-sm-4">
                <h3>Envie um Email</h3>
                <P class="text-muted">mh@gmail.com</P>
            </div>
            <div class="col-sm-4">
                <h3>Ligue</h3>
                <P class="text-muted">(51) 99090-9099</P>
            </div>
            <div class="col-sm-4">
                <h3>Encontre-nos</h3>
                <P class="text-muted"> Rua Osvino Hummes, 40, Salvador do Sul, Brasil</P>
            </div>
        </div>
    </div>
    <div class="bg-dark text-light text-center border-top wow fadeIn">
        <p class="mb-0 py-3 text-muted small">&copy; Copyright <script>
                document.write(new Date().getFullYear())
            </script> Made with <i class="ti-heart text-danger"></i> By <a href="http://devcrud.com">DevCRUD</a></p>
    </div>
    <!-- end of page footer -->

    <!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap affix -->
    <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- wow.js -->
    <script src="assets/vendors/wow/wow.js"></script>

    <!-- google maps -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtme10pzgKSPeJVJrG1O3tjR6lk98o4w8&callback=initMap"></script>

    <!-- FoodHut js -->
    <script src="assets/js/foodhut.js"></script>

</body>

</html>