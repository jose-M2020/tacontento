<?php
require_once 'views/header.php';
require_once 'controller/OfertaController.php';
?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
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
  <div class="carousel-item">
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
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





<?php
require_once 'views/footer.php';
?>