<?php
require_once 'app/views/admin/header.php';
?>
<form method="POST" action="<?= BASE_URL ?>/ofertas/<?= $oferta['id'] ?>" 
enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    <?php include_once "form.php" ?>
    
    <button type="submit" class="btn btn-primary" name="editar">Actualizar</button>
</form>

<?php
require_once 'app/views/admin/footer.php';
?>