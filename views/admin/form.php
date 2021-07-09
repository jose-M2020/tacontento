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
    <div class="row fuente">
        <div class="col-6">
            <label for="nombre">Titulo</label>
            <input class="form-control" type="text" required name="titulo" value="<?php if (isset($oferta['titulo'])) echo $oferta['titulo']; ?>" placeholder="Ingrese nombre">

        </div>
        <div class="col-6">
            <label for="descripcion">Descripción</label>
            <input class="form-control" type="text" required name="descripcion" value="<?php if (isset($oferta['descripcion'])) echo $oferta['descripcion']; ?>" placeholder="Ingrese la descripcion ">
        </div>

    </div>
    <br>
    <br>
    <div class="row fuente">
    <?php if (isset($oferta['img'])) : ?>
            <div class="col-3">
                <img class="photo-perfil-edit" src="storage/<?php echo $oferta['img'] ?>" alt="foto de perfil">

            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Cambiar imagen de oferta
                </button>
                
            </div>
        <?php else : ?>

            <div class="col-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Elegir foto de oferta
                </button>
            </div>
        <?php endif; ?>
        </div>
    <br>
    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Imagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="file" name="img" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </div>
    </div>
</div>