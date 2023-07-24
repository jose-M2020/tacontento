<div class="card card-signin">
  <div class="card-body">
    <h5 class="card-title">Iniciar Sesión</h5>
    <form action="index.php?page=login" method="POST" class="form-signin">
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="name@example.com" required autofocus>
        <label for="floatingInput">Email</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Contraseña</label>
      </div>
      <button class="btn btn-lg btn-primary d-block w-100 text-uppercase" type="submit"> Iniciar sesion</button><br>
      <div class="text-center">
        <span>¿Aún no tienes una cuenta? </span>
        <button class="link-primary" type="button" data-toggle="true">Regístrate</button>  
      </div>
    </form>
  </div>
</div>