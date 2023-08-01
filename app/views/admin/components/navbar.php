
<nav class="navbar bg-light shadow-sm py-3 px-3">
  <div class="container-fluid d-flex align-items-center">
    <div class="d-flex d-md-none align-items-center gap-3">
      <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
        <i class="fa-solid fa-bars"></i>
      </button>
      <div class="logo align-items-center">
        <img style="width:50px"  src="images/taco.png" alt="">
        <!-- <span class="logo-name">TA'CONTENTO</span> -->
      </div>
    </div>
    <!-- <form class="d-flex ms-auto" role="search">
      <div class="input-group">
        <input type="search" class="form-control" placeholder="Buscar" aria-label="Buscar">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
          <span class="icon"><i class="fas fa-search"></i></span>
        </button>
      </div>
    </form> -->
    <?php if (isset($_SESSION['usuario'])) : ?>
      <div class="ms-auto">
        <?php print_r($_SESSION['usuario']['nombre']) ?>
      </div>
    <?php endif; ?>
  </div>
</nav>