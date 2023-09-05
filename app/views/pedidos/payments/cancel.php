<?php $view->setLayout('layouts.client'); ?>

<?php $view->section('title', 'Compra cancelado'); ?>

<?php $view->setParams(['scrollEffect' => 'false']); ?>

<?php $view->section('content'); ?>

  <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 90vh;">
      <div class="status">
          <h1 class="font-40">Tu transacción fue cancelada!</h1>
      </div>
      <a href="<?= BASE_URL ?>/home" class="font-13">Regresar a la página principal</a>
  </div>

<?php $view->endSection(); ?>