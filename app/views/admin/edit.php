<?php
require_once 'app/views/admin/header.php';
?>
<form method="POST" action="<?= BASE_URL ?>/updateoferta&id=<?php echo $oferta['id']; ?>" 
enctype="multipart/form-data">

    <?php include_once "form.php" ?>
    
    <button type="submit" class="btn btn-primary" name="editar">Actualizar</button>
</form>

<?php
require_once 'app/views/admin/footer.php';
?>