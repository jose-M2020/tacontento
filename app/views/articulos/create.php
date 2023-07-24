<?php
require_once 'app/views/admin/header.php';
?>

<h1>Crear articulo</h1>
  <form method="POST" action="index.php?page=storearticulo" enctype="multipart/form-data" >
    
    <?php include_once "form.php" ?>

    <button class="btn btn-primary" name="registrar">Registrar</button>

  </form>


<?php
require_once 'app/views/admin/footer.php';
?>