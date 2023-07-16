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
            <a class="logo" href="index.php?page=homes"><img src="images/taco.png" alt="Logo"></a>
            <a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>
            <ul class="main-menu font-mountainsre" id="main-menu">
                <li><a href="index.php?page=homes">INICIO</a></li>
                <li><a href="03_menu.php">MENU</a></li>
                <li><a href="index.php?page=services">SERVICIOS</a></li>
                <li><a href="index.php?page=about">ACERCA DE NOSOTROS</a></li>
               
                <?php if (isset($_SESSION['cliente'])) : ?>
                    <li><a href="index.php?page=carrito">CARRITO DE COMPRAS</a></li>
                    <li><a href="index.php?page=createreserva">RESERVAS</a></li>
                    <li><a href="index.php?page=compras">COMPRAS</a></li>
                    <li><a href="index.php?page=logout">LOGOUT</a></li>
                <?php else : ?>
                    <li><a href="views/auth/login.php">LOGIN</a></li>
                <?php endif; ?>
            </ul>

            <div class="clearfix"></div>
        </div><!-- container -->
    </header>