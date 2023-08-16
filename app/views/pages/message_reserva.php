<?php
require_once 'app/views/components/header.php';
echo createNavbar();
?>

<br>
<br>
<section class="story-area left-text center-sm-text">
    <div class="container">
        <div class="heading">
            <br><br>
            <h2>Tu reserva fue realizada con éxito</h2>
            <h5 class="mt-10 mb-30">Para hacer valida tu reserva debes presentar el ticket de reserva
            No puedes cancelar la reserva despues de una hora, no se reenbolsará el dinero</h5>
            <a href="<?= BASE_URL ?>/imprimirreserva&id=<?php echo $lastid[0] ?>" class='btn btn-secondary' download="ticket.pdf">Imprimir ticket</a>
            <a href="<?= BASE_URL ?>/home" class='btn btn-primary'>Volver a menú</a>
        </div>
    </div><!-- container -->
</section>

<?php
require_once 'app/views/components/footer.php';
?>