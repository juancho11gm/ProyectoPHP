<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/signup.css">
    <title>Registro</title>
  </head>
  <body>
    <div class="container text-center">
      <form name="signupForm" onsubmit="return validateForm()" class="form-signin" method="post" action="../controlador/registro.php">
        <img class="mb-4" src="./assets/logo2.png" alt="" width="130">
        <h1 class="h3 mb-3 font-weight-normal">Registro</h1>
        <label for="inputUsername" class="sr-only">Usuario</label>
        <input name="username" type="text" class="form-control" placeholder="Usuario" required>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input name="password" type="password" class="form-control middle-input" placeholder="Contraseña"  required>
        <div class="col-6">
              <div class="form-check text-center">
                <input class="form-check-input" type="radio" name="tipousuario" value="0"checked>
                <label class="form-check-label">
                  Usuario
                </label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-check text-center">
                <input class="form-check-input" type="radio" name="tipousuario"  value="1" >
                <label class="form-check-label" >
                  Administrador
                </label>
              </div>
            </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registrarme</button>
      </form>
    </div>
  </body>
</html>