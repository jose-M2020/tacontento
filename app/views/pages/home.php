<?php $view->setLayout('layouts.client'); ?>

<?php $view->section('content'); ?>

  <?php
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
          'link' => BASE_URL.'/mis-reservas/create'
        ]
      ],
      2 => [
        'title' => 'Sabores Auténticos, Preparados con Pasión',
        'bgImage' => 'slider2.jpg',
        'button' => [
          'text' => 'VER MENÚ Y ORDENAR',
          'link' => BASE_URL.'/menu'
        ]
      ],
      3 => [
        'title' => 'Descubre nuestra amplia variedad de opciones en el menú',
        'bgImage' => 'slider3.jpg',
        'button' => [
          'text' => 'VER MENÚ Y ORDENAR',
          'link' => BASE_URL.'/menu'
        ]
      ],
    ];

    $testimonios = [
      1 => [
        'title' => 'Increíble comida y ambiente acogedor.',
        'comment' => 'Probé el platillo recomendado por el chef y superó todas mis expectativas. Sin duda, uno de los mejores restaurantes de la ciudad.',
        'user' => [
          'name'=> 'Kenia Sánchez',
          'avatar' => 'quoto-1-200x200.jpg',
          'role' => 'Ingeniera',
        ],
      ],
      2 => [
        'title' => 'El servicio fue excepcional.',
        'comment' => 'Los sabores auténticos, la atención amigable y el ambiente acogedor hicieron de nuestra visita a este restaurante una experiencia memorable. ¡Altamente recomendado!',
        'user' => [
          'name'=> 'Santander Rivera',
          'avatar' => 'quoto-2-200x200.jpg',
          'role' => 'Maestro',
        ],
      ],
      3 => [
        'title' => 'Fui a celebrar mi aniversario y quedé encantado.',
        'comment' => ' El ambiente romántico, la atención personalizada y los platos delicadamente preparados hicieron de esta noche una ocasión especial e inolvidable.',
        'user' => [
          'name'=> 'Juan Angel',
          'avatar' => 'quoto-3-200x200.jpg',
          'role' => 'Manager',
        ],
      ],
      4 => [
        'title' => 'Tacos deliciosos y auténticos.',
        'comment' => 'Los tacos que probamos en este restaurante eran simplemente increíbles. La carne estaba perfectamente sazonada, las tortillas eran frescas y blanditas, y los ingredientes complementarios agregaban un sabor espectacular.',
        'user' => [
          'name'=> 'Eduardo Hernandez',
          'avatar' => 'quoto-3-200x200.jpg',
          'role' => 'Arquitecto',
        ],
      ],
    ];

    $meals = [
      0 => [
        'name' => 'Desayunos',
        'description' => 'Disfruta de una variedad de opciones deliciosas para comenzar tu día con energía. Desde platos clásicos hasta creaciones únicas, tenemos algo para todos los paladares.',
        'schedule' => '8:00 am - 11:00 pm',
        'icon' => 'fa-solid fa-mug-saucer'
      ],
      1 => [
        'name' => 'Comidas',
        'description' => 'Nuestra selección de comidas ofrece una amplia gama de platillos sabrosos y nutritivos. Donde encontrarás el equilibrio perfecto para una comida satisfactoria.',
        'schedule' => '12:00 pm - 5:00 pm',
        'icon' => 'fa-solid fa-bowl-food'
      ],
      2 => [
        'name' => 'Cenas',
        'description' => 'Sumérgete en una experiencia culinaria excepcional con nuestras opciones de cena. Desde platos sofisticados hasta sabores reconfortantes, te invitamos a disfrutar de una cena inolvidable con nosotros.',
        'schedule' => '5:00 pm - 9:00 pm',
        'icon' => 'fa-solid fa-burger'
      ],
    ];
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

  <section class="container">
    <div class="heading">
      <h2>Principales Comidas</h2>
    </div>
    <div class="row justify-content-center">
      <?php foreach($meals as $item) : ?>
        <div class="col-md-4 col-xl-3 mb-sm-60 mb-md-0 wow fadeIn">
          <div class="position-relative h-100">
            <div class="position-absolute top-0 start-50 translate-middle bg-secondary text-white p-15 rounded-circle">
              <i class="<?php echo $item['icon'] ?> font-23"></i>
            </div>
            <div class="card text-center shadow h-100">
              <div class="card-body d-flex flex-column mt-25">
                <h5 class="card-title"><?php echo $item['name'] ?></h5>
                <p class="card-text mb-15 flex-grow-1"><?php echo $item['description'] ?></p>
                <a href="<?= BASE_URL ?>/menu" class="btn btn-primary">Ver menú</a>
              </div>
              <div class="card-footer text-muted">
                <?php echo $item['schedule'] ?>
              </div>
            </div>  
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="story-area  pos-relative" id="ofertas">

    <div class="container">
      <div class="heading">
        <h2>Ofertas</h2>
      </div>
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
        <h2>Nuestro restaurante</h2>
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

          <div 
            class="swiper-container"
            data-slide-effect="slide"
            data-autoheight="false"
            data-swiper-speed="500"
            data-swiper-margin="25"
            data-swiper-slides-per-view="3"
            data-swiper-breakpoints="true"
            data-scrollbar="true"
            data-swiper-loop="true"
            data-swpr-responsive="[1, 2]"
          >
              <div class="swiper-wrapper pb-90 pb-sm-60 left-text center-sm-text">
                  <?php  foreach($testimonios as $item): ?>
                    <div class="swiper-slide wow fadeIn">
                      <h4><?php echo $item['title'] ?></h4>
                      <p class="color-ash mb-50 mb-sm-30 mt-20"><?php echo $item['comment'] ?></p>
                      <div class="d-flex align-items-center gap-2">
                        <img class="circle-60" src="images/<?php echo $item['user']['avatar'] ?>" alt="">
                        <div>
                          <h6 class="color-primary font-13"><?php echo $item['user']['name'] ?></h6>
                          <span class="color-ash"><?php echo $item['user']['role'] ?></span>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>

                  
              </div><!-- swiper-wrapper -->

              <div class="swiper-pagination"></div>
          </div><!-- swiper-container -->
      </div><!-- container -->
  </section>

  <section class="container story-area left-text center-sm-text">
    <div class="heading">
      <h2>Contáctanos</h2>
    </div>
    <div class="row">
      <div class="col-md-5">
        <form>
          <!-- 2 column grid layout with text inputs for the first and last names -->
          <div class="row mb-4">
            <div class="col">
              <div class="form-outline">
                <input type="text" id="form3Example1" class="form-control" placeholder="Nombre" />
              </div>
            </div>
            <div class="col">
              <div class="form-outline">
                <input type="text" id="form3Example2" class="form-control" placeholder="Email" />
              </div>
            </div>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="form3Example3" class="form-control" placeholder="Asunto"/>
          </div>

          <!-- Message input -->
          <div class="form-outline mb-4">
            <textarea class="form-control" id="form4Example3" rows="7" placeholder="Mensaje"></textarea>
          </div>

          <!-- Submit button -->
          <button type="submit" class="btn btn-lg btn-primary btn-block w-100">Enviar</button>
        </form>
      </div>
      <div class="col-md-7">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3051.4524715572857!2d-99.13267580787318!3d19.446620520294974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f93a51307a9d%3A0xa6428535c81db6d3!2sMorelos%2C%20Mexico%20City%2C%20CDMX!5e0!3m2!1sen!2smx!4v1689563946495!5m2!1sen!2smx" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
    </div>
  </section>

<?php $view->endSection(); ?>