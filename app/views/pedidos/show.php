<?php
require_once 'app/views/admin/header.php';


$id = $p['id'];
$fecha = $p['fecha'];
$nombre = $p['nombre'];
$apellidos = $p['apellidos'];
$email = $p['email'];
$telefono = $p['telefono'];
$id_cliente = $p['id_cliente'];
$total = $p['total'];

?>


<div class="container">
    <h1>DATOS DEL PEDIDO</h1>
    <br>
    <div class="row">
      <div class="col-md-8">
        <h4>Platillos</h4>
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
      </div>
      <div class="col-md-4 shadow p-20 text-center user">
        <div class="user__photo mb-20">
            <img src="images/no-image.png" alt="" >
        </div>
        <div class="mb-20">
            <h4 class="mb-5"><?php echo $nombre ?> <?php echo $apellidos ?></h4>
            <span>Cliente #<?php echo $id_cliente ?></span>
        </div>
        <div class="d-flex justify-content-center gap-4 user__contacts">
          <div>
            <a href="tel:<?php echo $telefono ?>"><i class="fa-solid fa-phone"></i></a>
          </div>
          <div>
            <a href="https://wa.me/<?php echo $telefono ?>"><i class="fa-brands fa-whatsapp"></i></a>
          </div>
          <div>
            <a href="mailto: <?php echo $email ?>"><i class="fa-solid fa-envelope"></i></a>
          </div>
        </div>
      </div>
    </div>


<!-- <div class="alert alert-info">
    <h3 class="">Total $<?php echo $total ?></h3>
</div> -->

</div>
</div>