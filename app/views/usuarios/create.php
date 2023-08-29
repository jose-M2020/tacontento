<?php
require_once 'app/views/admin/header.php';
?>

<h1>Crear usuario</h1>
  <form method="POST" action="<?= BASE_URL ?>/usuarios" >
    
    <?php include_once "form.php" ?>

    <button class="btn btn-primary" name="registrar">Registrar</button>

  </form>


<?php
require_once 'app/views/admin/footer.php';
?>