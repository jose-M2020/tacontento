<?php $view->setLayout('layouts.client'); ?>

<?php $view->section('title', 'Crear reserva'); ?>

<?php $view->section('content'); ?>

    <?php
    include "./app/views/components/hero.php";
    echo $createHero('Reserva', 'about.jpg');
    ?>
    
    <section class="container story-area left-text center-sm-text">
      <div class="row g-5">
        <div class="col-md-12 col-lg-7">
            <div class="">
                <h2 class="mb-30">Reserve una mesa en nuestro restaurante</h2>
                <form method="POST" action="<?= BASE_URL ?>/mis-reservas">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 mb-3 fuente">
                        <!-- <div class="col form-floating">
                            <input class="form-control" type="text" name="nombre" required placeholder="Nombre completo">
                            <label for="nombre">Nombre completo</label>
                        </div>
                        <div class="col form-floating">
                            <input class="form-control" type="email" name="email" required placeholder="user@example.com">
                            <label for="email">Email</label>
                        </div>
                        <div class="col form-floating">
                            <input class="form-control" type="number" name="phone" required placeholder="Número telefónico">
                            <label for="phone">Teléfono</label>
                        </div> -->
                        <div class="col form-floating">
                            <input class="form-control" type="number" min="1" pattern="^[0-9]+" max="12" name="personas" required placeholder="Cantidad de personas">
                            <label for="personas">No. de Personas</label>
                        </div>
                        <div class="col form-floating">
                            <input class="form-control" type="date" required name="fecha" placeholder="Fecha de reserva">
                            <label for="fecha">Fecha</label>
                        </div>
                        <div class="col form-floating">
                            <select class="form-select" id="durationSelect" name='duracion'>
                                <option value="00:30:00">30 minutos</option>
                                <option value="01:00:00">1 hora</option>
                                <option value="01:30:00">1 hora y media</option>
                                <option value="02:00:00">2 horas</option>
                            </select>
                            <label for="durationSelect">Duración</label>
                        </div>
                    </div>
                    <!-- <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 mb-3 fuente">
                        <div class="col form-floating">
                            <input class="form-control" required type="time" name="hora">
                            <label for="hora">Hora</label>
                        </div>
                        
                    </div> -->
                    <div class="form-floating">
                        <textarea class="form-control w-100" name="notas_especiales" placeholder="Leave a comment here" id="request" style="height: 110px"></textarea>
                        <label label for="request">Solicitud especial</label>
                    </div>
                    <br>
                    <input type="hidden" readonly name="id_cliente" value="<?php echo $_SESSION['usuario']['id'] ?>">
                    <button name="registrar" value="registrar" class="btn btn-primary btn-lg">Reservar</button>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
          <div class="text-center p-30 shadow">
            <h3 class="font-25 mb-30">Nuestro horario de servicio</h3>
            <div class="mb-20">
                <p class="font-18 fw-bold">Lunes - Viernes</p>
                <span class="font-14">8:00 am - 10:00 pm</span>
            </div>
            <div class="">
                <p class="font-18 fw-bold">Sabado - Domingo</p>
                <span class="font-14">4:00 pm - 10:00 pm</span>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php $view->endSection(); ?>