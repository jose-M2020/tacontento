<?php
require_once 'views/header.php';
require_once 'controller/OfertaController.php';

$galleryItems = [
  'v1.jpg',
  'h1.jpg',
  'h2.jpg',
  'h6.jpg',
  'h4.jpg',
  'v3.jpg',
  'h3.jpg',
];

?>

<div id="carouselHero" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
    <li data-bs-target="#carouselHero" data-bs-slide-to="0" class="active"></li>
    <li data-bs-target="#carouselHero" data-bs-slide-to="1"></li>
    <li data-bs-target="#carouselHero" data-bs-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="images/slider1.jpg" alt="First slide">
      <div class="carousel-caption d-none h-30 align-items-center justify-content-center d-none d-lg-block">
        <h3 class="p-slider">TACO: EL ARTE DE COMER CON TORTILLA</h3>
        <div class="pos-bottom triangle-up"></div>
        <div class="pos-top triangle-bottom"></div>
        <h5><a href="#ofertas" class="btn-primaryc plr-25"><b>VER OFERTAS</b></a></h5>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="images/slider2.jpg" alt="Second slide">
      <div class="carousel-caption d-none h-30 align-items-center justify-content-center   d-none d-md-block">
        <h3 class="p-slider">¡EL TACO, TA´ CONTENTO! </h3>

        <div class="pos-bottom triangle-up"></div>
        <div class="pos-top triangle-bottom"></div>
        <h5><a href="#ofertas" class="btn-primaryc plr-25"><b>VER OFERTAS</b></a></h5>
      </div>
    </div>
    <div class="carousel-item ">
      <img class="d-block w-100" src="images/slider3.jpg" alt="Third slide">
      <div class="carousel-caption d-none h-30 align-items-center justify-content-center   d-none d-lg-block">
        <h3 class="p-slider">¿Y TÚ ERES O NO ERES TACO FAN?</h3>
        <div class="pos-bottom triangle-up"></div>
        <div class="pos-top triangle-bottom"></div>
        <h5><a href="#ofertas" class="btn-primaryc plr-25"><b>VER OFERTAS</b></a></h5>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselHero" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<section class="story-area  pos-relative" id="ofertas">

  <div class="container">
    <div class="heading">
      <h2>Ofertas</h2>
    </div>
    <?php
    $articulo = new OfertaController;
    $articulos = $articulo->obtener();
    ?>
    <?php if (isset($articulos)) : ?>

      <div class="card-group ">
        <?php foreach ($articulos as $a) : ?>
          <div class="card  col-lg-4 col-md-3 col-sm-12 col-xs-12">
            <img class="card-img-top " src="storage/<?php echo $a['img'] ?>" alt="Card image cap">
            <div class="card-footer">
              <h5 class="card-title"><?php echo $a['titulo'] ?></h5>
              <p class="card-text"><?php echo $a['descripcion'] ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
</section>

<section class="gallery story-area pos-relative">

  <div class="container">
    <div class="heading faded-text">
      <h2>Experiencia Gastronómica Inolvidable</h2>
    </div>
    <!-- Gallery -->
    <div class="gallery__content">
      <?php foreach ($galleryItems as $key => $item) : ?>
        <div class="gallery__item i<?php  echo ($key+1) ?>">
          <img
            class="gallery__img"
            src="images/gallery/<?php  echo $item ?>"
            alt=""
          >
        </div>
      <?php endforeach; ?>
    </div>
<!-- Gallery -->
</section>

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