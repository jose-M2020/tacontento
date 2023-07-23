<?php
require_once 'views/admin/header.php';
?>

<div class="container">
 
  <div class="row">
    <div class="col-8">
    <h1>Historial de ventas</h1>
    </div>
    <div class="ms-auto col-4 ">
      <form method="GET" action="index.php" autocomplete="off">
        <label for="search">
        <label for="dateInicio"><input class="form-control" type="date" name="search" > </label>
        </label>
        <button  class="btn btn-secondary" type="submit" name="page" value="venta" >Buscar </button>
      
      </form>
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
            <td> <?php echo $u['total'] ?> </td>
            <td> <?php echo $u['id_cliente'] ?> </td>
            <td>
            <a href="index.php?page=showpedido&id=<?php echo $u['id'] ?>" class='btn btn-outline-primary btn-sm' >Ver pedido</a>
            <a href="index.php?page=imprimirpedido&id=<?php echo $u['id'] ?>" class='btn btn-outline-info btn-sm' download="ticket.pdf">Imprimir ticket</a>
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
          <a class="page-link" href="index.php?page=venta&search=<?php echo $search ?>&p=<?php echo $i ?>">
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