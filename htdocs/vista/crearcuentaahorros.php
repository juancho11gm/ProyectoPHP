<?php
  session_start();
  $Usuario = $_SESSION['Usuario'];
 ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Crear Cuenta de Ahorros</title>
  </head>
  <body>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-2 text-dark" href="./perfil.php"><?php echo $Usuario; ?></a>
          <a class="p-2 text-dark" href="./cuentaahorros.php">Cuenta de ahorros</a>
          <a class="p-2 text-dark" href="./creditos.php">Créditos</a>
          <a class="p-2 text-dark" href="./tarjetacredito.php">Tarjetas de crédito</a>
          <a class="p-2 text-dark" href="./mensajes.php">Mensajes</a>
          <?php if($_SESSION['Rol']=='Administrador') echo '<a class="p-2 text-dark" href="./administrador.php">Administrador</a>';?>
      </nav>
      <a class="btn btn-outline-danger" href="../controlador/salir.php">Salir</a>
    </div>


    <div class="container text-center">
      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Nueva cuenta</h1>
        <p >Ingresar el saldo inicial en JaveCoins (1 JaveCoin = $ 1000 COP).</p>
        </div>
      <form class="form" action="../controlador/crearcuentaahorros.php" method="post">
        <div class="row">
          <div class="col-6">
            <label for="inputPassword2" class="sr-only">Saldo</label>
            <input type="number" name="saldo" class="form-control"  placeholder="Saldo" required>
          </div>
          <button type="submit" class="submit-btn btn btn-success">Agregar</button>


        </div>
      </form>
    </div>
  </body>
</html>
