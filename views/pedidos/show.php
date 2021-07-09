<?php
require_once 'views/admin/header.php';


$id = $p['id'];
$fecha = $p['fecha'];
$nombre = $p['nombre'];
$apellidos = $p['apellidos'];
$email = $p['email'];
$id_cliente = $p['id_cliente'];
$total = $p['total'];

?>


<div class="container">
    <h1>DATOS DE LA COMPRA</h1>
    <br>
    <div class="row fuente">
        <div class="col-3">
            <label for="descripcion">ID</label>
            <input class="form-control" type="text" readonly value="<?php echo $id ?>" placeholder="Ingrese la descripcion ">
        </div>
        <div class="col-3">
            <label for="nombre">Nombre</label>
            <input class="form-control" type="text" readonly value="<?php echo $nombre ?>">

        </div>
        <div class="col-3">
            <label for="descripcion">Apellidos</label>
            <input class="form-control" type="text" readonly value="<?php echo $apellidos ?>">
        </div>
        <div class="col-3">
            <label for="descripcion">email</label>
            <input class="form-control" type="text" readonly value="<?php echo $email ?>">
        </div>
    </div>
    <br>
    <div class="row fuente">
    
        <div class="col-3">
            <label for="descripcion">ID cliente</label>
            <input class="form-control" type="text" readonly value="<?php echo $id_cliente ?>">
        </div>
    </div>


<br><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="10%">ID producto</th>
            <th width="53%">Nombre</th>
            <th width="10%">Cantidad</th>
            <th width="10%">Precio</th>
            <th width="10%">Importe</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($articulos)) : ?>
            <?php for ($i = 0; $i < $limite; $i++) : ?>
                <tr>

                    <td><?php echo $articulos[$i]['id'] ?></td>
                    <td><?php echo $articulos[$i]['nombre'] ?></td>
                    <td> <?php echo $cantidad[$i] ?> </td>
                    <td> $<?php echo  $articulos[$i]['precio'] ?> </td>
                    <?php
                    $t = 0;
                    $t = $articulos[$i]['precio'] *  $cantidad[$i];
                    ?>

                    <td>
                        <?php echo number_format($t, 2); ?>
                    </td>
                </tr>
            <?php endfor; ?>
        <?php endif; ?>
    </tbody>
</table>
<br>
<div class="alert alert-info">
    <h3 class="">Total $<?php echo $total ?></h3>
</div>

</div>
</div>