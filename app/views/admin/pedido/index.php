<?php $view->setLayout('layouts.admin'); ?>

<?php $view->section('title', 'Pedidos'); ?>

<?php $view->section('content'); ?>

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
              <td class="d-flex gap-2 align-items-center">
                <a
                  href="<?= BASE_URL ?>/pedidos/<?php echo $u['id'] ?>"
                  class='btn btn-outline-primary btn-sm'
                  data-bs-toggle="tooltip"
                  data-bs-title="Ver detalles"
                >
                  <span class="icon"><i class="fas fa-eye"></i></span>
                </a>
                <div data-bs-toggle="tooltip" data-bs-title="Finalizar">
                  <form style="display: inline;" method="POST" action="<?= BASE_URL ?>/pedidos/<?php echo $u['id'] ?>">
                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" class=" btn btn-outline-danger" name="editar">
                      <span class="icon"><i class="fas fa-check"></i></span>
                    </button>
                  </form>
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
            <a class="page-link" href="<?= BASE_URL ?>/pedido&search=<?php echo $search ?>&p=<?php echo $i ?>">
              <?php echo $i ?>
            </a>
          </li>
        <?php endfor;  ?>
      </ul>
    </nav>
  </div>

<?php $view->endSection(); ?>