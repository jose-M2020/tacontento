<?php
  use Core\Http\Request;

  $request = new Request();
?>
<br>
<div class="container">
    <div class="row g-4 fuente mb-25">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="nombre">Identificador / nombre</label>
            <input
              class="form-control"
              type="text"
              required
              name="nombre"
              value="<?= isset($mesa['nombre']) ? $mesa['nombre'] : '' ?>"
              placeholder="Ingrese el identificador de la mesa(1, 2, A1, A1, B1, B2)"
            >
          </div>
          <div class="mb-3">
            <label for="capacidad">Capacidad</label>
            <input
              class="form-control"
              type="text"
              required
              name="capacidad"
              value="<?= isset($mesa['capacidad']) ? $mesa['capacidad'] : '' ?>"
              placeholder="Número de personas"
            >
          </div>
          <div class="">
            <label for="notas">Notas</label>
            <textarea
              class="form-control"
              name="notas"
              placeholder="Ingrese los detalles"
              rows="4"
              maxlength="200"
              required
            >
              <?= isset($mesa['descripcion']) ? $mesa['descripcion'] : ''; ?>
            </textarea>
          </div>
        </div>
    </div>