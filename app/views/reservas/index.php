<?php $view->setLayout('layouts.client'); ?>

<?php $view->section('title', 'Reservas'); ?>

<?php $view->section('content'); ?>

  <?php
    include "./app/views/components/hero.php";
    echo $createHero('Mis reservas', 'about.jpg');
  ?>

  <?php if (!empty($reservas)) ?>
    <section class="story-area left-text center-sm-text">
        <div class="container">
            <div class="table-responsive">
              <table class="table  table-bordered">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="15%">ID cliente</th>
                        <th width="15%">N. personas</th>
                        <th width="20%">Fecha_reservas </th>
                        <th width="20%">Hora</th>
                        <th width="20%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas as $u) : ?>
                        <tr>
                            <td><?php echo $u['id'] ?></td>
                            <td><?php echo $u['id_cliente'] ?></td>
                            <td><?php echo $u['personas'] ?> </td>
                            <td><?php echo $u['fecha'] ?> </td>
                            <td><?php echo $u['hora'] ?> </td>
                            <td>
                                <a href="<?= BASE_URL ?>/imprimirreserva&id=<?php echo $u['id'] ?>" class='btn btn-outline-info btn-sm' download="ticket.pdf">Imprimir reserva</a>
                            </td>
                    <?php endforeach; ?>
                </tbody>
              </table>
            </div>
        </div>
    </section>
    
<?php $view->endSection(); ?>