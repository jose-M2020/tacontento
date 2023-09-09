<?php $view->setLayout('layouts.client'); ?>

<?php $view->section('title', 'Nosotros'); ?>

<?php $view->section('content'); ?>

    <?php
      include "./app/views/components/hero.php";
      echo $createHero('Acerca de Nosotros', 'about.jpg');
    ?>

    <section class="story-area left-text center-sm-text">
        <div class="container">
            <div class="heading">
                <h5 class="mt-10 mb-30">Conoce más de nosotros</h5>
                <p class="mx-w-700x mlr-auto">Proin dictum viverra varius. Etiam vulputate libero dui, at pretium
                    elit elementum quis. Enean porttitor eros non ultrices convallis.
                    Vivamus quis dolor ut arcu lobortis finibus a vitae leo. Sed eget tempus sem.
                    Nullam sed lacus sed metus tincidunt lobortis lobortis at nibh. Morbi euismod, arcu in gravida rhoncus Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam iste quae, reprehenderit optio enim quos ut? Consectetur atque provident adipisci porro officia voluptates soluta? Enim illo expedita consequuntur quaerat eos.</p>
                    <br><br>
                    <p class="mx-w-700x mlr-auto">Proin dictum viverra varius. Etiam vulputate libero dui, at pretium
                    elit elementum quis. Enean porttitor eros non ultrices convallis.
                    Vivamus quis dolor ut arcu lobortis finibus a vitae leo. Sed eget tempus sem.
                    Nullam sed lacus sed metus tincidunt lobortis lobortis at nibh. Morbi euismod, arcu in gravida rhoncus Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam iste quae, reprehenderit optio enim quos ut? Consectetur atque provident adipisci porro officia voluptates soluta? Enim illo expedita consequuntur quaerat eos.</p>
            </div>
        </div><!-- container -->
    </section>


    <section class="story-area left-text center-sm-text">
        <div class="container">
            <div class="heading">
                <h2>Ubicación</h2>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3051.4524715572857!2d-99.13267580787318!3d19.446620520294974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f93a51307a9d%3A0xa6428535c81db6d3!2sMorelos%2C%20Mexico%20City%2C%20CDMX!5e0!3m2!1sen!2smx!4v1689563946495!5m2!1sen!2smx" width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div><!-- container -->
    </section>

<?php $view->endSection(); ?>