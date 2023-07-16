<?php
require_once 'views/admin/header.php';
?>

<?php 
    include "./views/components/hero.php";
    echo createHero('Reservas', 'menu.jpg');
?>

<div class="container">
  <h1>Reservas</h1>
  <div class="row">
    <div class="col-8">

    </div>
    <div class="ms-auto col-4 ">
    <form method="GET" action="index.php" autocomplete="off">
        <label for="search">
        <label for="dateInicio"><input class="form-control" type="date" name="search" > </label>
        </label>
        <button  class="btn btn-primary" type="submit" name="page" value="reservas" >Buscar </button>
      
      </form>
    </div>
  </div>
  <br><br>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width="10%">ID</th>
        <th width="15%">ID cliente</th>
        <th width="15%">N.Personas</th>
        <th width="20%">Fecha</th>
        <th width="20%">Hora</th>
        <th width="20%">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($reserva)) : ?>
        <?php foreach ($reserva as $u) : ?>
          <tr>
            <td><?php echo $u['id'] ?></td>
            <td><?php echo $u['id_cliente'] ?></td>
            <td><?php echo $u['personas'] ?> </td>
            <td><?php echo $u['fecha'] ?> </td>
            <td><?php echo $u['hora'] ?> </td>
            <td>
              <a href="index.php?page=showreserva&id=<?php echo $u['id'] ?>" class='btn btn-outline-info btn-sm'>Ver reserva</a>

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
          <a class="page-link" href="index.php?page=reserva&search=<?php echo $search ?>&p=<?php echo $i ?>">
            <?php echo $i ?>
          </a>
        </li>
      <?php endfor;  ?>
    </ul>
  </nav>
  <!-- Session message -->
  <?php if (isset($_SESSION['mensaje-reserva'])) : ?>
    <div class="alert alert-success" role="alert">
      <?php echo $_SESSION['mensaje-reserva'] ?>
    </div>
  <?php endif; ?>
</div>



<?php
require_once 'views/admin/footer.php';
?>