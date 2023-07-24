<?php

$footerItems = [
  'Restaurante' => [
    0 => [
      'title' => '',
      'links' => ''
    ]
  ],
  'Contacto' => [
    0 => [
      'title' => '',
      'links' => ''
    ]
  ],
  'Horario' => [
    0 => [
      'title' => '',
      'links' => ''
    ]
  ]
]

?>

<div class="">
  <footer class="py-5">
    <div class="container">
        <div class="row">
        <div class="col-6 col-md-2 mb-3">
        <h5 class="mb-3">Enlaces web</h5>
        <ul class="nav flex-column faded-text">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Ayuda</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Sobre nosotros</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Aviso de Privacidad</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Términos y Condiciones</a></li>
        </ul>
        </div>

        <div class="col-6 col-md-2 mb-3">
        <h5 class="mb-3">Contacto</h5>
        <ul class="nav flex-column faded-text">
          <li class="nav-item mb-2">
            <i class="me-2 fa-solid fa-location-dot"></i>Calle Morelos, CDMX, México
          </li>
          <li class="nav-item mb-2">
            <i class="me-2 fa-solid fa-phone"></i>+52 755 111 8092
          </li>
          <li class="nav-item mb-2">
            <i class="me-2 fa-solid fa-envelope"></i>tacontento@gmail.com
          </li>
        </ul>
        </div>

        <div class="col-6 col-md-2 mb-3">
        <h5 class="mb-3">Horario</h5>
        <ul class="nav flex-column faded-text">
          <li class="nav-item mb-2">
            <h6 class="font-12">Lunes - Sabado</h6>
            <p>10AM - 06PM</p>
          </li>
          <li class="nav-item mb-2">
            <h6 class="font-12">Domingo</h6>
            <p>10AM - 03PM</p>
          </li>
        </ul>
        </div>

        <div class="col-md-5 offset-md-1 mb-3">
        <form>
                <h5 class="mb-3">Mantente al tanto de nuestras ofertas</h5>
                <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                <label for="newsletter1" class="visually-hidden">Email address</label>
                <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                <button class="btn btn-primary" type="button">Suscribir</button>
                </div>
        </form>
        </div>
        </div>
        <div class="d-flex flex-column flex-sm-row justify-content-between pt-4 mt-4 border-top">
        <p>&copy;<script>document.write(new Date().getFullYear());</script> Tacontento. All rights reserved.</p>
        <ul class="list-unstyled d-flex">
        <li class="ms-3">
                <a class="faded-text" href="https://www.facebook.com/Tacontento-105787020769539/" target=”_blank”><i class="fa-brands fa-facebook"></i></a>
        </li>
        <li class="ms-3">
                <a class="faded-text" href="https://instagram.com/tacontentooficial?igshid=1ch2p7lbkj97k" target=”_blank”><i class="fa-brands fa-instagram"></i></a>
        </li>
        <li class="ms-3">
                <a class="faded-text" href="#" target=”_blank”><i class="fa-brands fa-twitter"></i></a>
        </li>
        </ul>
        </div>
    </div>
  </footer>
</div>

<!-- SCIPTS -->
<script src="public/plugin-frameworks/jquery-3.2.1.min.js"></script>
<script src="public/plugin-frameworks/bootstrap/bootstrap.bundle.min.js"></script>
<script src="public/plugin-frameworks/wow/wow.min.js"></script>
<script src="public/plugin-frameworks/swiper.js"></script>
<script src="public/common/scripts.js"></script>
<script src="public/common/solid.js"></script>

</body>
</html>