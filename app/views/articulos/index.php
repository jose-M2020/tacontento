<?php
require_once 'app/views/admin/header.php';
?>

<div class="container">
  <h1>Articulos del menu</h1>
  <div class="row">
    <div class="col-8">
      <a href="<?= BASE_URL ?>/createarticulo" class="btn btn-primary pull-rigth ">Registrar platillo</a>
    </div>
    <div class="ms-auto col-4 ">
      <form method="GET" action="index.php" autocomplete="off">
        <label for="search">
          <input class="form-control" type="text" name="search" placeholder="Indicio de busqueda">
        </label>
        <button  class="btn btn-secondary" type="submit" name="page" value="articulo" >Buscar </button>
      </form>
    </div>
  </div>
  <br><br>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width="20%">Nombre</th>
        <th width="50%">Descripcion</th>
        <th width="7%">Precio</th>
        <th width="8%">Tipo</th>
        <th width="15%">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($articulo)) : ?>
        <?php foreach ($articulo as $u) : ?>
          <tr>

            <td><?php echo $u['nombre'] ?></td>
            <td><?php echo $u['descripcion'] ?></td>
            <td> $<?php echo $u['precio'] ?> </td>
            <td> <?php echo $u['tipo'] ?> </td>
            <td class="d-flex gap-2 align-items-center">
              <a
                href="<?= BASE_URL ?>/editarticulo&id=<?php echo $u['id'] ?>"
                class='btn btn-outline-primary btn-sm'
                data-bs-toggle="tooltip"
                data-bs-title="Editar"
              >
                <span class="icon"><i class="fas fa-edit"></i></span>
              </a>
              <div data-bs-toggle="tooltip" data-bs-title="Eliminar">
                <button type="button" class=" btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?php echo $u['id'] ?>">
                  <span class="icon"><i class="fas fa-trash"></i></span>
                </button>
              </div>
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
          <a class="page-link" href="<?= BASE_URL ?>/articulo&search=<?php echo $search ?>&p=<?php echo $i ?>">
            <?php echo $i ?>
          </a>
        </li>
      <?php endfor;  ?>
    </ul>
  </nav>
</div>
<!-- Modal -->
<?php foreach ($articulo as $u) : ?>
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

          <form style="display: inline;" method="POST" action="<?= BASE_URL ?>/destroyarticulo&id=<?php echo $u['id'] ?>">
            <button type="submit" id="delete" class=" btn btn-danger" name="eliminar">Eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>


<?php
require_once 'app/views/admin/footer.php';
?>