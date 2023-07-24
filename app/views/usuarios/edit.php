<?php
require_once 'app/views/admin/header.php';
?>
<form method="POST" action="index.php?page=updateusuario&id=<?php echo $user['id']; ?>">

    <?php include_once "form.php" ?>
    
    <button type="submit" class="btn btn-primary" name="editar">Actualizar</button>
</form>

<?php
require_once 'app/views/admin/footer.php';
?>