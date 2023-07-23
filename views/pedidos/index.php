<?php
require_once 'views/admin/header.php';
?>

<div class="container">
  <h1>Pedidos</h1>
  <div class="row">
    <div class="col-8">

    </div>
    <div class="ms-auto col-4 ">
   
    </div>
  </div>
  <br><br>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width="15%">ID</th>
        <th width="20%">Fecha</th>
        <th width="20%">Total</th>
        <th width="15%">ID Cliente</th>
        <th width="20%">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($pedido)) : ?>
        <?php foreach ($pedido as $u) : ?>
          <tr>

            <td><?php echo $u['id'] ?></td>
            <td> <?php echo $u['fecha'] ?> </td>
            <td> $<?php echo $u['total'] ?> </td>
            <td> <?php echo $u['id_cliente'] ?> </td>
            <td>
              <a href="index.php?page=showpedido&id=<?php echo $u['id'] ?>" class='btn btn-outline-info btn-sm'>Ver pedido</a>

              <form style="display: inline;" method="POST" action="index.php?page=updatepedido&id=<?php echo $u['id'] ?>">

                <button type="submit" class=" btn btn-outline-danger" name="editar"> Finalizar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
  <!--Pagination -->
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <?php for ($i = 1; $i <= $section; $i++) :  ?>
        <li class="page-item">
          <a class="page-link" href="index.php?page=pedido&search=<?php echo $search ?>&p=<?php echo $i ?>">
            <?php echo $i ?>
          </a>
        </li>
      <?php endfor;  ?>
    </ul>
  </nav>
</div>



<?php
require_once 'views/admin/footer.php';
?>