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
          <div id='calendar'></div>
            <!-- <div class="table-responsive">
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
            </div> -->
        </div>
    </section>
  
    <!-- Modal -->
    <div class="modal fade" id="reservaModal" tabindex="-1" aria-labelledby="reservaModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="reservaModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

<?php $view->endSection(); ?>

<?php $view->section('scripts'); ?>
  
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <script>
    // const myModal = new bootstrap.Modal('#reservaModal', {
    //   keyboard: false
    // })

    // myModal.open();

    const reservaModal = new bootstrap.Modal('#reservaModal');

    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('calendar');
      const modal = document.getElementById('reservaModal');
      const reservas = <?php echo $reservas ?>;
      console.log(reservas);

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: { center: 'dayGridMonth,timeGridWeek' },
        selectable: true,
        // events: '<?php $reservas ?>',
        events: reservas,

        select: async function (start, end, allDay) {
          // $("#reservaModal").modal('show');
          reservaModal.show();
          console.log(start)
        },
      });
      calendar.render();
    });
  </script>

<?php $view->endSection(); ?>