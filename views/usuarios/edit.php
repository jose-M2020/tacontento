<?php
require_once 'views/admin/header.php';
?>
<form method="POST" action="index.php?page=updateusuario&id=<?php echo $user['id']; ?>">

    <?php include_once "form.php" ?>
    
    <button type="submit" class="btn btn-primary d-block w-100" name="editar">Actualizar</button>

    <?php if (isset($_SESSION['mensaje'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['mensaje'] ?>
        </div>
    <?php endif; ?>
</form>

<?php
require_once 'views/admin/footer.php';
?>