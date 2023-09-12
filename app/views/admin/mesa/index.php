<?php $view->setLayout('layouts.admin'); ?>

<?php $view->section('title', 'mesas'); ?>

<?php $view->section('content'); ?>
  
  <div class="container">
    <h1>Mesas</h1>
    <div class="row mb-60">
      <div class="col-8">
        <a href="<?= BASE_URL ?>/mesas/create" class="btn btn-primary pull-rigth ">Crear mesa</a>
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

    <?php if (!empty($mesas)) : ?>
      <table class="table table-bordered" >
        <thead>
          <tr>
            <th  width="5%" >ID</th>
            <th  width="30%">Nombre</th>
            <th  width="50%" >Capacidad</th>
            <th  width="50%" >Notas</th>
            <th  width="50%" >Estado</th>
            <th  width="10%">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($mesas as $mesa) : ?>
            <tr >
              <td><?= $mesa['id'] ?></td>
              <td><?= $mesa['nombre'] ?></td>
              <td><?= $mesa['capacidad'] ?></td>
              <td><?= $mesa['notas'] ?></td>
              <td><?= $mesa['status'] ?></td>
              <td class="d-flex gap-2 align-items-center">
                <a 
                  href="<?= BASE_URL ?>/mesas/<?= $mesa['id'] ?>/edit"
                  class='btn btn-outline-primary btn-sm'
                  data-bs-toggle="tooltip"
                  data-bs-title="Editar"
                >
                  <span class="icon"><i class="fas fa-edit"></i></span>
                </a>
                <div data-bs-toggle="tooltip" data-bs-title="Eliminar">
                  <button
                    type="button"
                    class=" btn btn-outline-danger btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#modal<?= $mesa['id'] ?>"
                  >
                    <span class="icon"><i class="fas fa-trash"></i></span>
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="text-center">
        <h3>No hay mesas registradas</h3>
      </div>
    <?php endif; ?>

    <!--Pagination -->
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $section; $i++) :  ?>
          <li class="page-item">
            <a class="page-link" href="<?= BASE_URL ?>/mesas?search=<?= $search ?>&p=<?= $i ?>">
              <?= $i ?>
            </a>
          </li>
        <?php endfor;  ?>
      </ul>
    </nav>
  </div>

  <!-- Modal -->
  <?php foreach ($mesas as $mesa) : ?>
    <div class="modal fade" id="modal<?= $mesa['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form style="display: inline;" method="POST" action="<?= BASE_URL ?>/mesas/<?= $mesa['id'] ?>">
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" id="delete" class=" btn btn-danger" name="eliminar">Eliminar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

<?php $view->endSection(); ?>