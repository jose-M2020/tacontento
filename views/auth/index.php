<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>TACONTENTO</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Dosis:wght@400;600;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <!-- Stylesheets -->
  <link href="../../public/plugin-frameworks/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="../../public/plugin-frameworks/swiper.css" rel="stylesheet">
  <link href="../../public/fonts/ionicons.css" rel="stylesheet">

  <link href="../../public/common/css/login.css" rel="stylesheet">

</head>
<body>
  <header>
    <div class="container">
      <div class="d-flex align-items-center">
        <a class="logo d-flex align-items-center gap-1" href="../../index.php?page=homes">
          <img src="../../images/taco.png" alt="Logo">
          <h1 class="logo-name">Ta'contento</h1>
        </a>
      </div>    
    </div>
  </header>
  <div class="container form form--login d-flex justify-content-center align-items-center mt-25">
    <div class="w-100">
      <div class="row w-100 justify-content-center">
        <div class="form__content col-md-12 col-lg-10 d-flex p-0">
          <div class="w-md-50 form__register">
            <div class="form__info">
              <h2 class="mb-20 ">Crear una cuenta</h2>
              <button class="btn btn-lg btn-primary" data-toggle="true">Registrarme</button>
              
            </div>
            <?php require_once './registrar.php' ?>
          </div>
          <div class="w-md-50 form__login form--active">
            <div class="form__info">
              <button class="btn btn-lg btn-primary" data-toggle="true">Iniciar Sesión</button>
              
            </div>
            <?php require_once './login.php' ?>
          </div>

        
          <!-- <div class="form__overlay w-50">
            <div class="form__overlay-content form__overlay-login">
              <button class="btn btn-lg btn-primary" data-toggle="true">Iniciar Sesión</button>
              
            </div>
            <div class="form__overlay-content form__overlay-register">
              <button class="btn btn-lg btn-primary" data-toggle="true">Registrarme</button>
              
            </div>
          </div>
          <div class="form__card w-50">
            <div class="card form__login">
              <div class="card-body">
                <h5 class="card-title text-center">Iniciar Sesión</h5>
                <form action="../../index.php?page=accseso" method="POST" class="form-signin">
                  <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
                    <label for="inputEmail">Email address</label>
                  </div>
                  <br>
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                    <label for="inputPassword">Password</label>
                  </div>
                  <br><br>
                  <button class="btn btn-lg btn-primary d-block w-100 text-uppercase" type="submit"> Iniciar sesion</button><br>    
                </form>
              </div>
            </div>
            <div class="card form__register">
              <div class="card-body">
                <h5 class="card-title text-center">Registro</h5>
                <form action="../../index.php?page=accseso" method="POST" class="form-signin">
                  <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
                    <label for="inputEmail">Email address</label>
                  </div>
                  <br>
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                    <label for="inputPassword">Password</label>
                  </div>
                  <br><br>
                  <button class="btn btn-lg btn-primary d-block w-100 text-uppercase" type="submit">Registrarme</button><br>    
                </form>
              </div>
            </div>
          </div> -->
        
        </div>
      </div>

    </div>
  </div>

  <!-- SCIPTS -->
  <script src="../../public/plugin-frameworks/jquery-3.2.1.min.js"></script>
  <script src="../../public/plugin-frameworks/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="../../public/plugin-frameworks/wow/wow.min.js"></script>
  <script src="../../public/plugin-frameworks/swiper.js"></script>

  <script>
    $(function() {
      let currentForm = 'login';

      $('button[data-toggle="true"]').on('click', function () {
        $(`.form__${currentForm}`).removeClass('form--active');
        $('.form').removeClass(`form--${currentForm}`);
        
        currentForm = currentForm === 'login' ? 'register' : 'login';
        $(`.form__${currentForm}`).addClass('form--active');
        $('.form').addClass(`form--${currentForm}`);

        // $(`.form`).removeClass(`form--${currentForm}`);
        // currentForm = currentForm === 'login' ? 'register' : 'login';
        // $(`.form`).addClass(`form--${currentForm}`);
      });
    });
  </script>
</body>