<?php $view->setLayout('layouts.client'); ?>

<?php $view->section('title', 'Menú'); ?>

<?php $view->section('content'); ?>

  <?php
    require_once "app/views/components/hero.php";
    echo $createHero('Menú', 'menu.jpg');
  ?>

  <section>
    <div class="container menu">
      <?php if (isset($articulos)) : ?>
        <div class="row">
          <div class="col-sm-12">
            <ul class="selecton mb-70">
              <li><a class="active" href="#" data-select="*">
                <i class="fa-solid fa-utensils"></i>
                <b>TODO</b>
              </a></li>
              <li><a href="#" data-select="desayuno">
                <i class="fa-solid fa-mug-saucer"></i>
                <b>DESAYUNOS</b>
              </a></li>
              <li><a href="#" data-select="comidas">
                <i class="fa-solid fa-bowl-food"></i>
                <b>COMIDAS</b>
              </a></li>
              <li><a href="#" data-select="cena">
                <i class="fa-solid fa-burger"></i>
                <b>CENAS</b>
              </a></li>
            </ul>
          </div>
        </div>
        <div class="row g-4">
          <!--col-sm-12-->
          <?php foreach ($articulos as $item) : ?>
            <div
              class="menu__item col-md-6 food-menu <?php echo $item['tipo'] ?> wow fadeInUp"
              data-wow-delay="0.1s"
              data-itemid="<?php  echo $item['id'] ?>"
            >
              <div
                class="menu__item-content d-flex gap-3 rounded pe-2"
                data-bs-toggle="popover"
                data-bs-placement="right"
              >
                <div>
                  <img 
                    class="br-3"
                    src="storage/<?php echo $item['img'] ?>"
                    alt="Menu Image"
                    loading="lazy">
                </div>
                <!--s-left-->
                <div class="menu__item-left w-100 d-flex flex-column justify-content-center">
                  <div>
                    <h5 class="mb-10 d-flex align-items-center justify-content-between">
                      <b> <?php echo $item['nombre'] ?></b>
                      <b class="color-primary">$<?php echo $item['precio'] ?></b>
                    </h5>
                    <p class="pe-70"><?php echo $item['descripcion'] ?> </p>
                  </div>
                </div>
                
                <!--s-right-->
              </div><!-- sided-90x -->
            </div><!-- food-menu -->
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <!--row-->
    </div><!-- container -->
  </section>

  <!-- POPOVER CONTENT -->

  <div class="popover-overlay" id="popover_content_wrapper" style="display: none">
    <div class="menu__form">
      <form method="POST" id="addCart" action="<?= BASE_URL ?>/carrito">
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Cantidad (obligatorio)</label>
          <input type="number" class="form-control" min="1" pattern="^[0-9]+" name="cantidad" required placeholder="1">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Comentarios adicionales</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="detalles" placeholder="Agrega aquí tus instrucciones especiales"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-md w-100" name="agregar">Agregar al carrito</button>
      </form>
    </div>
    <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-secondary p-2" id="close" style="cursor: pointer;">
      <i class="fa-solid fa-x"></i>
    </span>
  </div>

  <!-- Modal -->
  <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> -->

<?php $view->endSection(); ?>

<?php $view->section('scripts'); ?>
  <script>
    const menuItems = <?php echo json_encode($articulos); ?>;
      

    // $('#exampleModal').on('show.bs.modal', function() {
    //   console.log(this)
    // })

    $(document).on('shown.bs.modal', '#exampleModal', function (event) {
      const triggerElement = $(event.relatedTarget); // Button that triggered 
      const itemId = $(triggerElement[0]).data('itemid')

      const currentData = menuItems.find(item => item.id === itemId)
    });

  </script>
<?php $view->endSection(); ?>