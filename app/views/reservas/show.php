<?php
require_once 'app/views/admin/header.php';

?>

<div class="container">
    <h1>DATOS DEL CLIENTE</h1>
    <br>
    <div class="row fuente">
        <div class="col-4">
            <label for="descripcion">ID</label>
            <input class="form-control" type="text" readonly value="<?php echo $reserva['id'] ?>" placeholder="Ingrese la descripcion ">
        </div>
        <div class="col-4">
            <label for="nombre">Nombre</label>
            <input class="form-control" type="text" readonly value="<?php echo $reserva['nombre'] ?>">

        </div>
        <div class="col-4">
            <label for="descripcion">Apellidos</label>
            <input class="form-control" type="text" readonly value="<?php echo $reserva['apellidos'] ?>">
        </div>
        
    </div>
    <br>
    <div class="row fuente">
    <div class="col-4">
            <label for="descripcion">email</label>
            <input class="form-control" type="text" readonly value="<?php echo $reserva['email'] ?>">
        </div>
        <div class="col-4">
            <label for="descripcion">Telefono</label>
            <input class="form-control" type="text" readonly value="<?php echo $reserva['telefono'] ?>">
        </div>
        <div class="col-4">
            <label for="id_cliente">ID cliente</label>
            <input class="form-control" type="text" readonly value="<?php echo $reserva['id_cliente'] ?>">
        </div>
      
    </div>
    <br><br>
    <h2>DATOS DE RESERVA</h2>
    <br><br>
    <div class="row fuente">
    <div class="col-4">
            <label for="personas">N.Personas</label>
            <input class="form-control" type="text" readonly value="<?php echo $reserva['personas'] ?>">
        </div>
        <div class="col-4">
            <label for="fecha">Fecha</label>
            <input class="form-control" type="text" readonly value="<?php echo $reserva['fecha'] ?>">
        </div>
        <div class="col-4">
            <label for="hora">Hora</label>
            <input class="form-control" type="text" readonly value="<?php echo $reserva['hora'] ?>">
        </div>
    </div>

</div>
</div>