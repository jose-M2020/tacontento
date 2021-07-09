<?php
require_once 'views/header.php';
?>

<br><br><br><br>
<section class="counter-section section center-text" id="counter">
    <div class="container">
        <div class="heading">

            <h2>Nuestros Servicios</h2>
        </div>
        <br> <br><br>
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

<section class="story-area  pos-relative">
    <div class="pos-bottom triangle-up"></div>
    <div class="pos-top triangle-bottom"></div>
    <div class="container">
        <div class="heading">

            <h2>Que dicen nuestros clientes</h2>
        </div>

        <div class="swiper-container" data-slide-effect="slide" data-autoheight="false" data-swiper-speed="500" data-swiper-margin="25" data-swiper-slides-per-view="3" data-swiper-breakpoints="true" data-scrollbar="true" data-swiper-loop="true" data-swpr-responsive="[1, 2]">

            <div class="swiper-wrapper pb-90 pb-sm-60 left-text center-sm-text">
                <div class="swiper-slide">
                    <h4>Azombroso lugar</h4>
                    <p class="color-ash mb-50 mb-sm-30 mt-20">El mejor lugar que he visitado lo recomiendo mucho excelente. </p>
                    <img class="circle-60 mb-20 " src="images/quoto-1-200x200.jpg" alt="">
                    <h6><b class="color-primary">Kenia Sánchez</b>,<b class="color-ash">Cliente</b>
                    </h6>
                </div><!-- swiper-slide -->

                <div class="swiper-slide">
                    <h4>Los mejores tacos, el mejor servicio</h4>
                    <p class="color-ash mb-50 mb-sm-30 mt-20"> 100% recomendado para toda la familia, lo vuelvo a repetir  100% recomendado</p>
                    <img class="circle-60 mb-20" src="images/quoto-2-200x200.jpg" alt="">
                    <h6><b class="color-primary">Santander Rivera</b>,<b class="color-ash">Cliente</b>
                    </h6>
                </div><!-- swiper-slide -->

                <div class="swiper-slide">
                    <h4>Los mejores antojitos en la ciudad</h4>
                    <p class="color-ash mb-50 mb-sm-30 mt-20">Nunca creí decir esto, pero es lo mejor que hay en la ciudad. </p>
                    <img class="circle-60 mb-20" src="images/quoto-3-200x200.jpg" alt="">
                    <h6><b class="color-primary">Juan Angel</b>,<b class="color-ash">Visitante</b></h6>
                </div><!-- swiper-slide -->

                <div class="swiper-slide">
                    <h4>Riquisimo</h4>
                    <p class="color-ash mb-50 mb-sm-30 mt-20">Sin duda alguna mis alumnos son los mejores,
                     felicidades por no dormir todas las vacaciones, los tkm </p>
                    <img class="circle-60 mb-20" src="images/quoto-3-200x200.jpg" alt="">
                    <h6><b class="color-primary">Eduardo Hernandez</b>,<b class="color-ash">Visitante</b>
                    </h6>
                </div><!-- swiper-slide -->
            </div><!-- swiper-wrapper -->

            <div class="swiper-pagination"></div>
        </div><!-- swiper-container -->
    </div><!-- container -->
</section>



<?php
require_once 'views/footer.php';
?>