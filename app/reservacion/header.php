<?php

if (!isset($_SESSION)) {
    session_start();
}

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>TACONTENTO</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/taco.png">
    <!-- Stylesheets -->
    <link href="public/plugin-frameworks/bootstrap.min.css" rel="stylesheet">
    <link href="public/plugin-frameworks/swiper.css" rel="stylesheet">
    <link href="public/fonts/ionicons.css" rel="stylesheet">
    <link href="public/common/css/styles.css" rel="stylesheet">
    <link href="public/fonts/all.min.css" rel="stylesheet">

    <script src="public/common/all.min.js"></script>

</head>

<body>
    <header>
        <div class="container">
            <a class="logo" href="<?= BASE_URL ?>/home"><img src="images/taco.png" alt="Logo"></a>
            <a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>
            <ul class="main-menu font-mountainsre" id="main-menu">
                <li><a href="<?= BASE_URL ?>/home">INICIO</a></li>
                <li><a href="<?= BASE_URL ?>/menu">MENU</a></li>
                <li><a href="<?= BASE_URL ?>/services">SERVICIOS</a></li>
                <li><a href="<?= BASE_URL ?>/about">ACERCA DE NOSOTROS</a></li>
               
                <?php if (isset($_SESSION['usuario'])) : ?>
                    <li><a href="<?= BASE_URL ?>/carrito">CARRITO DE COMPRAS</a></li>
                    <li><a href="<?= BASE_URL ?>/createreserva">RESERVAS</a></li>
                    <li><a href="<?= BASE_URL ?>/compras">COMPRAS</a></li>
                    <li><a href="<?= BASE_URL ?>/logout">LOGOUT</a></li>
                <?php else : ?>
                    <li><a href="views/auth">LOGIN</a></li>
                <?php endif; ?>
            </ul>

            <div class="clearfix"></div>
        </div><!-- container -->
    </header>