<?php
require_once 'app/views/components/header.php';
require_once "./app/views/components/hero.php";

echo createNavbar();
echo createHero('Nuestros Servicios', 'services.jpg');
?>

<section class="counter-section section center-text" id="counter">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 ">
                <div class="mb-30 ">
                    <i class="fas fa-parking fa-7x"></i>

                    <h3><b><span>Estacionamiento</span></b>
                    </h3>

                </div><!-- margin-b-30 -->
            </div><!-- col-md-3-->

            <div class="col-sm-12 col-md-6 ">
                <div class="mb-30">
                    <i class="fas fa-swimmer  fa-7x"></i>
                    <h3><b><span>Alberca</span></b>
                </div><!-- margin-b-30 -->
            </div><!-- col-md-3-->

            <div class="col-sm-12 col-md-6">
                <div class="mb-30">
                    <i class="fas fa-truck fa-7x"></i>
                    <h3><b><span>Domicilio</span></b>
                </div><!-- margin-b-30 -->
            </div><!-- col-md-3-->

            <div class="col-sm-12 col-md-6 ">
                <div class="mb-30">
                    <i class="fas fa-music fa-7x"></i>
                    <h3><b><span>Musica en vivo</span></b>
                </div><!-- margin-b-30 -->
            </div><!-- col-md-3-->

        </div><!-- row-->
    </div><!-- container-->
</section><!-- counter-section-->



<?php
require_once 'app/views/components/footer.php';
?>