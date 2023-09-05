<?php
  require_once 'app/config/config.php';

  use Core\Http\Request;

  $request = new Request();

  $navItems = [
    0 => [
      "name" => 'INICIO',
      "link" => '<?= BASE_URL ?>/home',
      "checkLogin" => false,
    ],
    1 => [
      "name" => 'MENU',
      "link" => '<?= BASE_URL ?>/menu',
      "checkLogin" => false,
    ],
    2 => [
      "name" => 'SERVICIOS',
      "link" => '<?= BASE_URL ?>/services',
      "checkLogin" => false,
    ],
    3 => [
      "name" => 'ACERCA',
      "link" => '<?= BASE_URL ?>/about',
      "checkLogin" => false,
    ],
    4 => [
      "icon" => 'fa-solid fa-cart-shopping',
      "link" => '<?= BASE_URL ?>/carrito',
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
          "link" => '<?= BASE_URL ?>/createreserva',
          "checkLogin" => true,
        ],
        1 => [
          "name" => 'COMPRAS',
          "ICON" => "fa-solid fa-utensils",
          "link" => '<?= BASE_URL ?>/compras',
          "checkLogin" => true,
        ],
        2 => [
          "name" => 'CERRAR SESIÓN',
          "ICON" => "fa-solid fa-right-from-bracket",
          "link" => '<?= BASE_URL ?>/logout',
          "checkLogin" => true,
        ],
      ]
    ],
  ];

  $title = $this->getSection('title') ? ($this->getSection('title') . ' - ') : '';
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>
      <?= $title ?>Ta'Contento
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?= $request->getFullRoute('/images/taco.png') ?>">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Dosis:wght@400;600;800&display=swap" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="<?= $request->getFullRoute('/public/plugin-frameworks/animate/animate.min.css') ?>" rel="stylesheet">
    <!-- Stylesheets -->
    <link href="<?= $request->getFullRoute('/public/plugin-frameworks/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= $request->getFullRoute('/public/plugin-frameworks/swiper.css') ?>" rel="stylesheet">
    <link href="<?= $request->getFullRoute('/public/fonts/ionicons.css') ?>" rel="stylesheet">
    <link href="<?= $request->getFullRoute('/public/common/css/styles.css') ?>" rel="stylesheet">
    <!-- <link href="public/fonts/all.min.css" rel="stylesheet"> -->
    
    <!-- CDN font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="<?= $request->getFullRoute('/public/common/all.min.js') ?>"></script>

</head>

<body>
  <?php 
    include_once "components/navbar.php";
    require_once('./app/views/components/message.php');

    echo $createNavbar($this->params['scrollEffect'] ?? 'true');
  ?>

  <main class="">
    <?= $this->getSection('content'); ?>
  </main>

  <?php 
    include_once "components/footer.php";
    echo($this->getSection('scripts'));
  ?>
</body>
</html>