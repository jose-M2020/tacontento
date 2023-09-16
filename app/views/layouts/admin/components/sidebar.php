
<?php
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
      ],
      6 => [
          'name' => 'Mesas',
          'icon' => 'fas fa-table',
          'page' => 'mesas',
      ]
  ];
?>

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