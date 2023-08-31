
<?php 
  require_once 'app/config/config.php';

  use Core\Http\Request;

  $request = new Request();

  $route = $request->getUrlRoutes()[0];
  
  $navItems = [
      0 => [
          'name' => 'Ofertas',
          'icon' => 'fas fa-gifts',
          'page' => 'ofertas',
      ],
      1 => [
          'name' => 'Pedidos',
          'icon' => 'fas fa-clipboard-list',
          'page' => 'pedidos',
      ],
      2 => [
          'name' => 'Reservas',
          'icon' => 'fas fa-concierge-bell',
          'page' => 'reservas',
      ],
      3 => [
          'name' => 'Menú',
          'icon' => 'fas fa-clipboard',
          'page' => 'platillos',
      ],
      4 => [
          'name' => 'Ventas',
          'icon' => 'far fa-credit-card',
          'page' => 'ventas',
      ],
      5 => [
          'name' => 'Clientes',
          'icon' => 'fas fa-address-card',
          'page' => 'usuarios',
      ]
  ];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="<?= $request->getFullRoute('/images/taco.png') ?>">
  <title>ADMIN - TACONTENTO</title>
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Dosis:wght@400;600;800&display=swap" rel="stylesheet">
  <!-- Libraries Stylesheet -->
  <link href="<?= $request->getFullRoute('/public/plugin-frameworks/animate/animate.min.css') ?>" rel="stylesheet">
  
  <link href="<?= $request->getFullRoute('/public/plugin-frameworks/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= $request->getFullRoute('/public/plugin-frameworks/swiper.css') ?>" rel="stylesheet">
  <link href="<?= $request->getFullRoute('/public/fonts/ionicons.css') ?>" rel="stylesheet">
  <link href="<?= $request->getFullRoute('/public/common/css/admin.css') ?>" rel="stylesheet">
  <!-- <link href="<?= $request->getFullRoute('/public/fonts/all.min.css') ?>" rel="stylesheet"> -->
  <script src="<?= $request->getFullRoute('/public/common/all.min.js') ?>"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <nav class="nav d-flex flex-row offcanvas offcanvas-start offcanvas-mobile" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
      
    <div class="d-flex flex-column menu-fixed">
      <div class="logo align-items-center mb-30 d-none d-md-flex">
          <img style="width:50px"  src="<?= $request->getFullRoute('/images/taco.png') ?>" alt="">
          <span class="logo-name">TA'CONTENTO</span>
      </div>
      <ul class="ps-0 mb-auto">
          <?php foreach($navItems as $item) : ?>
            <li class="li">
              <a class="nav__a <?php if($route === $item['page']) echo 'active'; ?>" href="<?= BASE_URL ?>/<?php echo $item['page'] ?>">
                <span class="icon"><i class="<?php echo $item['icon'] ?>"></i></span>
                <?php echo $item['name'] ?>
              </a>
            </li>
          <?php endforeach ; ?>
      </ul>
      <div class="li">
        <a class="nav__a" href="<?= BASE_URL ?>/logout">
          <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
          Logout
        </a>
      </div>
    </div>
  </nav>

    <!-- <span style="color: #fff">
      <i class="fas fa-bars"></i>
    </span> -->
  <main class="contenedor">
    <?php require_once('./app/views/admin/components/navbar.php') ?>
    <?php require_once('./app/views/components/message.php') ?>
    <div class="plr-sm-0 p-30">
    