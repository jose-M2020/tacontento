<?php $view->setLayout('layouts.client'); ?>

<?php $view->section('title', 'Reservas'); ?>

<?php $view->section('content'); ?>

    <?php
    include "./app/views/components/hero.php";
    echo createHero('Mis reservas', 'about.jpg');
    ?>

    <section class="story-area left-text center-sm-text">
        <div class="container">
            <div class="heading">
                <br>
                <h2>Crear Reserva</h2>
            </div>
            <br>
            <form method="POST" action="<?= BASE_URL ?>/storereserva">
                <div class="row fuente">
                    <div class="col-lg-4 col-md-6">
                        <label for="personas">N.Personas</label>
                        <input class="form-control" type="number" min="1" pattern="^[0-9]+" max="12" name="personas" required placeholder="Cantidad de personas">
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <label for="fecha">Fecha</label>
                        <input class="form-control" type="date" required name="fecha" placeholder="Fecha de reserva">
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <label for="hora">Hora</label>
                        <input class="form-control" required type="time" name="hora">
                    </div>
                </div>
                <br>
                <input type="hidden" readonly name="id_cliente" value="<?php echo $_SESSION['usuario']['id'] ?>">
                <button name="registrar" value="registrar" class="btn btn-primary d-block w-100">Reservar</button>
            </form>
        </div>
    </section>

    <?php if (!empty($reservas)) ?>
    <section class="story-area left-text center-sm-text">
        <div class="container">
            <div class="heading">
                <br>
                <h2>Mis Reservas</h2>
            </div>
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
                        </tr>

                    

                    <?php endforeach; ?>

                </tbody>
            </table>
            </div>
        </div>
    </section>
    
<?php $view->endSection(); ?>