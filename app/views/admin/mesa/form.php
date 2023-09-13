<?php
  use Core\Http\Request;

  $request = new Request();

  $statusArray = ['Disponible', 'Ocupada', 'Reservada', 'Fuera de servicio'];
?>
<br>
<div class="container">
    <div class="row g-4 fuente mb-25">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="nombre">No. de mesa / Identificador</label>
            <input
              class="form-control"
              type="text"
              required
              name="nombre"
              value="<?= isset($mesa['nombre']) ? $mesa['nombre'] : '' ?>"
              placeholder="Ejemplo: 1, 2, A1, Planta Baja A1"
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
          <?php if(isset($mesa['status'])): ?>
            <div>
              <label for="status">Estado</label>
              <select class="form-select" name="status" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <?php foreach($statusArray as $status): ?>
                  <option
                    value="<?= $status ?>"
                    <?= $status === $mesa['status'] ? 'selected' : '' ?>
                  >
                    <?= $status ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          <?php endif; ?>
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