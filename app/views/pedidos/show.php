<?php
require_once 'app/views/admin/header.php';

$id = $pedido['id'];
$fecha = $pedido['fecha'];
$nombre = $pedido['nombre'];
$apellidos = $pedido['apellidos'];
$email = $pedido['email'];
$telefono = $pedido['telefono'];
$id_cliente = $pedido['id_cliente'];
$total = $pedido['total'];

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
                <?php if (!empty($pedido['articulos'])) : ?>
                  <?php foreach ($pedido['articulos'] as $item) : ?>
                    <tr>
                      <td><?php echo $item['id'] ?></td>
                      <td><?php echo $item['nombre'] ?></td>
                      <td> <?php echo $item['cantidad'] ?> </td>
                      <td> $<?php echo  $item['precio'] ?> </td>
                      <?php
                        $t = 0;
                        $t = $item['precio'] *  $item['cantidad'];
                      ?>
                      <td>
                        $<?php echo number_format($t, 2); ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="row justify-content-end">
          <div class="col-md-3 d-flex justify-content-end font-13">
            <span class="me-100">Total</span>
            <span>$<?php echo number_format($pedido['total'], 2) ?></span>
          </div>
        </div>
      </div>
      <div class="col-md-4 shadow p-20 text-center user">
        <div class="user__photo mb-20">
            <img src="<?= $request->getFullRoute('/images/no-image.png'); ?>" alt="" >
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