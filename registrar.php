<?php
require_once 'views/header.php';

?>
<body>
    <header>
        <div class="container">
            <a class="logo" href="index.php"><img src="images/taco.png" alt="Logo"></a>
        </div>
    </header>
    <br><br>
<br>
<section class="counter-section section center-text" id="counter">
<div class="container">
        <div class="heading">

            <h2>Formulario de registro</h2>
        </div>
    </div><!-- container-->
    <form method="POST" action="index.php?page=storeusuario" >
        <div class="container">
            <div class="row fuente">
                <div class="col-6">
                    <label for="nombre">Nombre</label>
                    <input class="form-control" type="text" name="nombre" placeholder="Ingrese nombre" maxlength="40">

                </div>
                <div class="col-6">
                    <label for="materno">Apellidos</label>
                    <input class="form-control" type="text" name="apellidos" placeholder="Ingrese el apellidos " maxlength="40">
                </div>

            </div>
            <br>
            <div class="row fuente">
                <div class="col-4">
                    <label for="edad">Edad</label>
                    <input class="form-control" type="text" name="edad" placeholder="Ingrese edad" maxlength="2">
                </div>
                <div class="col-4">
                    <label for="telefono">Telefono</label>
                    <input class="form-control" type="text" name="telefono" placeholder="Ingrese numero telefonico" maxlength="11">
                </div>

                <div class="col-4">
                    <label for="paterno">Email</label>
                    <input class="form-control" type="text" name="email" placeholder="Ingrese el email" maxlength="80">
                </div>

            </div>
            <br>
            <div class="row fuente">
                <div class="col-4">
                    <label for="paterno">Contraseña</label>
                    <input class="form-control" type="password" name="password" placeholder="Ingrese contraseña para el sistema">
                </div>

            </div>
            <br>
            <div class="row fuente">
                <div class="col-4">
                    <label for="direccion">Direccion</label>
                    <input class="form-control" type="text" name="direccion" placeholder="Ingrese su direccion" maxlength="80">
                </div>

            </div>
            <br>
            <button class="btn btn-primary  d-block w-100" name="cliente" value="cliente">Registrar</button>
        </div>
       
    </form>
</section>  
</body>
<?php
require_once 'views/footer.php';
?>