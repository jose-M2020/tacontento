<?php $view->setLayout('layouts.admin'); ?>

<?php $view->section('title', 'Editar oferta'); ?>

<?php $view->section('content'); ?>

    <form method="POST" action="<?= BASE_URL ?>/ofertas/<?= $oferta['id'] ?>" 
    enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        <?php include_once "form.php" ?>
        
        <button type="submit" class="btn btn-primary" name="editar">Actualizar</button>
    </form>

<?php $view->endSection(); ?>