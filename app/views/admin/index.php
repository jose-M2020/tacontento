<?php
require_once 'header.php';
?>

<div class="container">
  <h1>Oferta</h1>
  <div class="row">
    <div class="col-8">
      <a href="index.php?page=createoferta" class="btn btn-primary pull-rigth ">Registrar oferta</a>
    </div>
    <div class="ms-auto col-4 ">
      <form method="GET" action="index.php" autocomplete="off">
        <label for="search">
          <input class="form-control" type="text" name="search" placeholder="Indicio de busqueda">
        </label>
        <button  class="btn btn-secondary" type="submit" name="page" value="dashboard" >Buscar </button>
      </form>
    </div>
  </div>
  <br><br>
  <table class="table table-bordered" >
    <thead>
      <tr>
        <th  width="15%" >ID</th>
        <th  width="20%">Titulo</th>
        <th  width="40%" >Descripcion</th>
        <th  width="15%">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($oferta)) : ?>
        <?php foreach ($oferta as $u) : ?>
          <tr >
          <td><?php echo $u['id'] ?></td>
            <td><?php echo $u['titulo'] ?></td>
            <td><?php echo $u['descripcion'] ?></td>
            <td>
              <a href="index.php?page=editoferta&id=<?php echo $u['id'] ?>" class='btn btn-outline-primary btn-sm'>Editar</a>

              <button type="button" class=" btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?php echo $u['id'] ?>">
                Eliminar
              </button>
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
          <a class="page-link" href="index.php?page=dashboard&search=<?php echo $search ?>&p=<?php echo $i ?>">
            <?php echo $i ?>
          </a>
        </li>
      <?php endfor;  ?>
    </ul>
  </nav>
  <!-- Session message -->
  <?php if (isset($_SESSION['delete'])) : ?>
    <div class="alert alert-success" role="alert">
      <?php echo $_SESSION['delete'] ?>
    </div>
  <?php endif; ?>
</div>
<!-- Modal -->
<?php foreach ($oferta as $u) : ?>
  <div class="modal fade" id="modal<?php echo $u['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar?</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

          <form style="display: inline;" method="POST" action="index.php?page=destroyoferta&id=<?php echo $u['id'] ?>">
            <button type="submit" id="delete" class=" btn btn-danger" name="eliminar">Eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>


<?php
require_once 'footer.php';
?>