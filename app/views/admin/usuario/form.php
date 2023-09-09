<?php

    $error = function($field){
        if (isset($_SESSION['errores'])){
            foreach ($_SESSION['errores'] as $key =>$dato) {
                $errores[$key]= $dato;
            }
            if(isset($errores[$field])) return $errores[$field];
        }
    };

?>
<div class="container">
    <div class="row fuente">
        <div class="col-4">
            <label for="nombre">Nombre</label>
            <input class="form-control" type="text" required name="nombre"
            value ="<?php if(isset($user['nombre'])) echo $user['nombre'];?>"  placeholder="Ingrese nombre">

        </div>
        <div class="col-4">
            <label for="materno">Apellidos</label>
            <input class="form-control" type="text" required name="apellidos" 
            value ="<?php if(isset($user['apellidos'])) echo $user['apellidos'];?>" placeholder="Ingrese el apellidos ">
        </div>
        <div class="col-4">
            <label for="edad">Edad</label>
            <input class="form-control" type="text" required name="edad"
            value ="<?php if(isset($user['edad'])) echo $user['edad'];?>"  placeholder="Ingrese edad">
        </div>

    </div>
    <br>
    <div class="row fuente">
       
        <div class="col-4">
            <label for="telefono">Telefono</label>
            <input class="form-control" type="text"required name="telefono" 
            value ="<?php if(isset($user['telefono'])) echo $user['telefono'];?>" placeholder="Ingrese numero telefonico">
        </div>
        <div class="col-8">
            <label for="direccion">Direccion</label>
            <input class="form-control" type="text" required name="direccion"
            value ="<?php if(isset($user['direccion'])) echo $user['direccion'];?>"  placeholder="Ingrese la direccion">
        </div>

       
    </div>
    <br>
    <div class="row fuente">
    <div class="col-4">
            <label for="paterno">Email</label>
            <input class="form-control" type="text" required name="email"
            value ="<?php if(isset($user['email'])) echo $user['email'];?>"  placeholder="Ingrese el email">
        </div>

        <div class="col-4">
            <label for="paterno">Contraseña</label>
            <input class="form-control" type="password" required name="password" 
            value ="<?php if(isset($user['password'])) echo $user['password'];?>" placeholder="Ingrese contraseña para el sistema">
        </div>

    </div>
    <br>