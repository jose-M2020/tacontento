<?php
require_once 'app/views/admin/header.php';
?>
<form method="POST" action="<?= BASE_URL ?>/platillos/<?php echo $articulo['id']; ?>" 
enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    <?php include_once "form.php" ?>
    <button type="submit" class="btn btn-primary">Actualizar</button>

    <?php if (isset($_SESSION['mensaje'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['mensaje'] ?>
        </div>
    <?php endif; ?>
</form>

<?php
require_once 'app/views/admin/footer.php';
?>