<?php function createNavbar($scrollEffect = 'true') { ?>
    <header data-scroll-effect="<?php echo $scrollEffect ?>">
        <div class="container d-flex justify-content-between">
            <div class="d-flex align-items-center">
              <a class="logo d-flex align-items-center" href="index.php?page=home">
                <img src="images/taco.png" alt="Logo">
                <h1 class="logo-name">Ta'contento</h1>
              </a>
            </div>
            <button class="faded-text menu-nav-icon" data-menu="#main-menu">
              <i class="ion-navicon"></i>
            </button>
            

            <ul class="main-menu" id="main-menu">
              <li><a class="faded-text" href="index.php?page=home">INICIO</a></li>
              <li><a class="faded-text" href="index.php?page=menu">MENU</a></li>
              <li><a class="faded-text" href="index.php?page=services">SERVICIOS</a></li>
              <li><a class="faded-text" href="index.php?page=about">ACERCA</a></li>
              <?php if (isset($_SESSION['cliente'])) : ?>
                <li>
                  <a class="faded-text position-relative" href="index.php?page=carrito&idUsuario=<?php echo $_SESSION['cliente']['id'] ?>">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="bg-primary position-absolute top-0 start-100 translate-middle badge border border-light rounded-pill d-flex justify-content-center align-items-center p-2" style="width: 20px; height:20px;">
                      <?php echo($_SESSION['cliente']['cartNum']) ?>
                    </span>
                  </a>
                </li>                  
                <div class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle faded-text" data-bs-toggle="dropdown">
                      <i class="fa-solid fa-circle-user"></i>
                      Cuenta
                  </a>
                  <div class="dropdown-menu account dropdown-menu-end m-0">
                      <a class="dropdown-item faded-text" href="index.php?page=createreserva"><i class="me-3 fa-solid fa-table-list"></i>RESERVAS</a>
                      <a class="dropdown-item faded-text" href="index.php?page=compras"><i class="me-3 fa-solid fa-utensils"></i>COMPRAS</a>
                      <hr class="dropdown-divider">
                      <a class="dropdown-item faded-text" href="index.php?page=logout"><i class="me-3 fa-solid fa-right-from-bracket"></i>Cerrar sesión</a>
                  </div>
                </div>
              <?php else : ?>
                  <li>
                    <a class="btn btn-primary faded-text" href="index.php?page=auth">Entrar</a>
                  </li>
              <?php endif; ?>
              <!-- <button class="btn btn-sm btn-primary" type="button">Ordenar</button> -->
            </ul>
        </div><!-- container -->
    </header>
<?php } ?>