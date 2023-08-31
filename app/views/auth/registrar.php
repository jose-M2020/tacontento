<div class="card card-signup">
    <div class="card-body">
    <h5 class="card-title">Crea tu cuenta</h5>
    <form method="POST" action="<?= BASE_URL ?>/register" class="form-signup">
        <div class="row">
          <div class="col-6">
            <div class="form-floating mb-3">
              <input class="form-control" type="text" name="nombre" placeholder="Ingrese nombre" maxlength="40" required>
              <label for="nombre">Nombre*</label>
            </div>
          </div>
          <div class="col-6">
            <div class="form-floating mb-3">
              <input class="form-control" type="text" name="apellidos" placeholder="Ingrese el apellidos " maxlength="40" required>
              <label for="materno">Apellidos*</label>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
              <div class="form-floating mb-3">
                <input class="form-control" type="number" name="edad" placeholder="Ingrese edad" maxlength="2" required>
                <label for="edad">Edad*</label>
              </div>
            </div>
            <div class="col-lg-6">
                <div class="form-floating mb-3">
                  <input class="form-control" type="text" name="telefono" placeholder="Ingrese numero telefonico" maxlength="11" required>
                  <label for="telefono">Telefono*</label>
                </div>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="email" name="email" placeholder="Ingrese el email" maxlength="80" required>
            <label for="paterno">Email*</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="password" name="password" placeholder="Ingrese contraseña para el sistema" required>
            <label for="paterno">Contraseña*</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="direccion" placeholder="Ingrese su direccion" maxlength="80">
            <label for="direccion">Direccion</label>
        </div>

      <button class="btn btn-lg btn-primary d-block w-100 text-uppercase" type="submit">Registrarme</button><br>
      <div class="text-center">
        <span>¿Ya tienes una cuenta? </span>
        <button class="link-primary" type="button" data-toggle="true">Inicia Sesión</button>  
      </div>
    </form>
    </div>
</div>



