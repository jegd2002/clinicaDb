<section class="hero is-primary is-fullheight">
  <div class="hero-body">
    <div class="container">
      <div class="columns is-centered">
        <div class="column is-5-tablet is-4-desktop is-3-widescreen">
          <form action="" method="POST" class="box">
            <div class="field">
              <label for="" class="label">Usuario</label>
              <div class="control has-icons-left">
                <input type="text" name="login_usuario" placeholder="Username" pattern="[a-zA-Z0-9]{4,20}" class="input" required>
                <span class="icon is-small is-left">
                  <i class="fa fa-envelope"></i>
                </span>
              </div>
            </div>
            <div class="field">
              <label for="" class="label">Contraseña</label>
              <div class="control has-icons-left">
                <input type="password" name="login_clave" pattern="[a-zA-Z0-9]{7,100}" placeholder="*******" class="input" required>
                <span class="icon is-small is-left">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
            </div>
            <div class="field">
              <label for="" class="checkbox">
                <input type="checkbox">
               Remember me
              </label>
            </div>
            <div class="field">
              <button class="button is-success">
                Login
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
      $insLogin->iniciarSesionControlador();
  }
?>