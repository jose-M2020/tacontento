<?php

if (!isset($_SESSION)) {
    session_start();
}


$navItems = [
  0 => [
    "name" => 'INICIO',
    "link" => 'index.php?page=home',
    "checkLogin" => false,
  ],
  1 => [
    "name" => 'MENU',
    "link" => 'index.php?page=menu',
    "checkLogin" => false,
  ],
  2 => [
    "name" => 'SERVICIOS',
    "link" => 'index.php?page=services',
    "checkLogin" => false,
  ],
  3 => [
    "name" => 'ACERCA',
    "link" => 'index.php?page=about',
    "checkLogin" => false,
  ],
  4 => [
    "icon" => 'fa-solid fa-cart-shopping',
    "link" => 'index.php?page=carrito',
    "checkLogin" => true,
  ],
  5 => [
    "name" => "CUENTA",
    "icon" => 'fa-solid fa-cart-shopping',
    "link" => '#',
    "checkLogin" => true,
    "children" => [
      0 => [
        "name" => 'RESERVAS',
        "ICON" => "fa-solid fa-table-list",
        "link" => 'index.php?page=createreserva',
        "checkLogin" => true,
      ],
      1 => [
        "name" => 'COMPRAS',
        "ICON" => "fa-solid fa-utensils",
        "link" => 'index.php?page=compras',
        "checkLogin" => true,
      ],
      2 => [
        "name" => 'CERRAR SESIÓN',
        "ICON" => "fa-solid fa-right-from-bracket",
        "link" => 'index.php?page=logout',
        "checkLogin" => true,
      ],
    ]
  ],
]

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>TACONTENTO</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/taco.png">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Dosis:wght@400;600;800&display=swap" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="public/plugin-frameworks/animate/animate.min.css" rel="stylesheet">
    <!-- Stylesheets -->
    <link href="public/plugin-frameworks/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="public/plugin-frameworks/swiper.css" rel="stylesheet">
    <link href="public/fonts/ionicons.css" rel="stylesheet">
    <link href="public/common/css/styles.css" rel="stylesheet">
    <!-- <link href="public/fonts/all.min.css" rel="stylesheet"> -->
    
    <!-- CDN font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="public/common/all.min.js"></script>

</head>

<body>
  <?php 
    include "./app/views/components/Navbar.php";
    require_once('./app/views/components/message.php');
  ?>