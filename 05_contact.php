<?php
require_once 'views/components/header.php';
?>

<?php 
    include "./views/components/hero.php";
    echo createHero('Acerca de Nosotros', 'about.jpg');
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
           
        </div>
    </div><!-- container -->
</section>
<?php
require_once 'views/components/footer.php';
?>