<?php
require_once 'views/components/header.php';
require_once 'controller/OfertaController.php';

$galleryItems = [
  1 => [
    'img' => 'v1.jpg',
    'text' => 'El auténtico sabor del trompo de pastor, ¡una experiencia irresistible!',
  ],
  2 => [
    'img' => 'h1.jpg',
    'text' => 'La comida que une a tu familia.',
  ],
  3 => [
    'img' => 'h2.jpg',
    'text' => 'Alimenta tu alma al aire libre.',
  ],
  4 => [
    'img' => 'h6.jpg',
    'text' => 'Mariachis en vivo. ¡Deleita tus oídos!',
  ],
  5 => [
    'img' => 'h4.jpg',
    'text' => 'Reserva tu mesa. ¡Saborea la experiencia!',
  ],
  6 => [
    'img' => 'v3.jpg',
    'text' => 'Encuentra tu lugar en nuestra mesa.',
  ],
  7 => [
    'img' => 'h3.jpg',
    'text' => '¡Sabores explosivos en cada bocado!',
  ],
  // 'v1.jpg',
  // 'h1.jpg',
  // 'h2.jpg',
  // 'h6.jpg',
  // 'h4.jpg',
  // 'v3.jpg',
  // 'h3.jpg',
];

$carouselItems = [
  1 => [
    'title' => '¡Eventos y Música en Vivo para Disfrutar!',
    'bgImage' => 'slider1.jpg',
    'button' => [
      'text' => 'RESERVAR MESA',
      'link' => '#ofertas'
    ]
  ],
  2 => [
    'title' => 'Sabores Auténticos, Preparados con Pasión',
    'bgImage' => 'slider2.jpg',
    'button' => [
      'text' => 'VER MENÚ Y ORDENAR',
      'link' => ''
    ]
  ],
  3 => [
    'title' => 'Descubre nuestra amplia variedad de opciones en el menú',
    'bgImage' => 'slider3.jpg',
    'button' => [
      'text' => 'VER MENÚ Y ORDENAR',
      'link' => ''
    ]
  ],
]

?>

<div id="carouselHero" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner shadow-4-strong">
    <?php foreach ($carouselItems as $key => $item) : ?>
      <div class="carousel-item <?php if($key === 1) echo 'active' ?>">
        <img class="d-block w-100" src="images/carousel/<?php echo $item['bgImage'] ?>" alt="First slide">
        <div class="carousel-caption d-none align-items-center justify-content-center d-none d-lg-block">
          <div class="container position-relative">
            <div class="main mb-50">
              <h3 class="p-slider animated fadeInRight mb-15"><?php echo $item['title'] ?></h3>
              <h5 class="animated fadeInRight data-delay-100ms" data-delay="100ms">
                <a href="<?php echo $item['button']['link'] ?>" class="btn-primaryc plr-25 plr-md-10"><b><?php echo $item['button']['text'] ?></b></a>
              </h5>
            </div>
            <div class="carousel-controls d-flex align-items-center animated fadeIn">
              <span class="me-25">
                <b class="font-20 color-primary">0<?php echo $key ?></b>
                /0<?php echo(count($carouselItems)) ?>
              </span>
              <button class="font-16 me-15" type="button" data-bs-target="#carouselHero" data-bs-slide="prev">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="font-16" type="button" data-bs-target="#carouselHero" data-bs-slide="next">
                <i class="fa-solid fa-arrow-right-long"></i>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
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

      <div class="row justify-content-center g-3">
        <?php foreach ($articulos as $a) : ?>
          <div class="col-12 col-md-4 col-lg-3 flex-grow-1 position-relative wow fadeIn">
            <div class="card">
              <img class="card-img-top " src="storage/<?php echo $a['img'] ?>" alt="Card image cap">
              <div class="card-footer">
                <h5 class="card-title"><?php echo $a['titulo'] ?></h5>
                <p class="card-text"><?php echo $a['descripcion'] ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
</section>

<!-- Gallery -->
<section class="gallery story-area pos-relative">
  <div class="container">
    <div class="heading faded-text">
      <h2>Experiencia Gastronómica Inolvidable</h2>
    </div>
    <div class="gallery__content">
      <?php foreach ($galleryItems as $key => $item) : ?>
        <div class="gallery__item i<?php  echo ($key) ?> wow fadeInUp" data-wow-delay="<?php echo $key*100 ?>ms">
          <img
            class="gallery__img"
            src="images/gallery/<?php  echo $item['img'] ?>"
            alt=""
          >
          <div class="gallery__info">
            <span><?php  echo $item['text'] ?></span>
          </div>
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
require_once 'views/components/footer.php';
?>