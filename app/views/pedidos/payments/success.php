<?php
  require_once 'app/views/components/header.php';

  echo createNavbar(false);
?>

  <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 90vh;">
      <div class="status">
          <h1 class="font-40">La compra se realizo con exito!</h1>
      </div>
  </div>

<?php
  require_once 'app/views/components/footer.php';
?>