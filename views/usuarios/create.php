<?php
require_once 'views/admin/header.php';
?>

<h1>Crear usuario</h1>
  <form method="POST" action="index.php?page=storeusuario" >
    
    <?php include_once "form.php" ?>

    <button class="btn btn-primary btn-block" name="registrar">Registrar</button>

    <?php if (isset($_SESSION['mensaje-usuario'])): ?>
      <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['mensaje-usuario']?>
      </div>
    <?php endif; ?>

  </form>


<?php
require_once 'views/admin/footer.php';
?>