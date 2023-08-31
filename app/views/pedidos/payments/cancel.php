<?php
  require_once 'app/views/components/header.php';
  echo createNavbar(false);
?>

  <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 90vh;">
      <div class="status">
          <h1 class="font-40">Tu transacción fue cancelada!</h1>
      </div>
      <a href="<?= BASE_URL ?>/home" class="font-13">Regresar a la página principal</a>
  </div>

<?php
  require_once 'app/views/components/footer.php';
?>