<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>TACONTENTO</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
  <link rel="stylesheet" href="fonts/beyond_the_mountains-webfont.css" type="text/css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <!-- Stylesheets -->
  <link href="../../public/plugin-frameworks/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="../../public/plugin-frameworks/swiper.css" rel="stylesheet">
  <link href="../../public/fonts/ionicons.css" rel="stylesheet">

  <link href="../../public/common/css/login.css" rel="stylesheet">

</head>
<header>
  <div class="container">
    <a class="logo" href="../index.php"><img src=" ../../images/taco.png" alt="Logo"></a>
  </div>
</header>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>

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
              <button class="btn btn-lg btn-google d-block w-100 text-uppercase" type="submit"> Iniciar sesion</button><br>
              <a class="btn btn-lg btn-facebook d-block w-100 text-uppercase" href="./registrar.php">Registrarse</a>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>


</body>