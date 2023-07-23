<?php
require_once 'views/admin/header.php';
?>
<form method="POST" action="index.php?page=updateoferta&id=<?php echo $oferta['id']; ?>" 
enctype="multipart/form-data">

    <?php include_once "form.php" ?>
    
    <button type="submit" class="btn btn-primary" name="editar">Actualizar</button>
</form>

<?php
require_once 'views/admin/footer.php';
?>