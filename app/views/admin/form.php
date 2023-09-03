<?php

$error = function ($field) {
    if (isset($_SESSION['errores'])) {
        foreach ($_SESSION['errores'] as $key => $dato) {
            $errores[$key] = $dato;
        }
        if (isset($errores[$field])) return $errores[$field];
    }
};

?>
<br>
<div class="container">
    <div class="row g-4 fuente mb-25">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="nombre">Titulo</label>
            <input class="form-control" type="text" required name="titulo" value="<?php if (isset($oferta['titulo'])) echo $oferta['titulo']; ?>" placeholder="Ingrese nombre">
          </div>
          <div class="">
            <label for="descripcion">Descripción</label>
              <textarea class="form-control" name="descripcion" value="" placeholder="Ingrese la descripcion " rows="6" maxlength="200" required><?php if (isset($oferta['descripcion'])) echo $oferta['descripcion']; ?></textarea>
          </div>
        </div>
        <div class="col-md-6">
            <div class="row fuente">
                <?php if (isset($oferta['img'])) : ?>
                    <div class="mb-3">
                        <img class="photo-perfil-edit" src="<?= $request->getFullRoute('/storage/'.$oferta['img']); ?>" alt="foto de perfil">
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                            Cambiar imagen de oferta
                        </button>
                    </div>
                <?php else : ?>   
                    <div class="">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                            Elegir foto de oferta
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Imagen</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="file" name="img" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </div>
    </div>
</div>