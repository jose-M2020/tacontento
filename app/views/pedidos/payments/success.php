<?php $view->setLayout('layouts.client'); ?>

<?php $view->section('title', 'Compra realizada'); ?>

<?php $view->setParams(['scrollEffect' => 'false']); ?>

<?php $view->section('content'); ?>

  <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 90vh;">
      <div class="status">
          <h1 class="font-40">La compra se realizo con exito!</h1>
      </div>
  </div>

<?php $view->endSection(); ?>