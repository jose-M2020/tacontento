<?php
  use Core\Http\Request;

  $request = new Request();
?>
<br>
<div class="container">
    <div class="row g-4 fuente mb-25">
        <div class="col-md-6">
          <div class="mb-20">
            <label for="nombre">No. de mesa / Identificador *</label>
            <input
              class="form-control"
              type="text"
              required
              name="nombre"
              value="<?= isset($mesa['nombre']) ? $mesa['nombre'] : '' ?>"
              placeholder="Ejemplo: 1, 2, A1, Planta Baja A1"
            >
          </div>
          <div class="mb-20">
            <label for="capacidad">Capacidad *</label>
            <input
              class="form-control"
              type="text"
              required
              name="capacidad"
              value="<?= isset($mesa['capacidad']) ? $mesa['capacidad'] : '' ?>"
              placeholder="Número de personas"
            >
          </div>
          <div class="mb-20">
            <label for="status">Estado</label>
            <select class="form-select" name="status" aria-label="Default select example">
              <option selected>Seleccionar estado</option>
              <?php foreach(RESERVATION_STATUS as $key => $value): ?>
                <option
                  value="<?= $key ?>"
                  <?= (isset($mesa['status']) && $key === $mesa['status']) ? 'selected' : '' ?>
                >
                  <?= $key ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="">
            <label for="notas">Notas</label>
            <textarea
              class="form-control"
              name="notas"
              placeholder="Ingrese los detalles"
              rows="4"
              maxlength="200"
            ><?= isset($mesa['notas']) ? $mesa['notas'] : ''; ?></textarea>
          </div>
        </div>
    </div>