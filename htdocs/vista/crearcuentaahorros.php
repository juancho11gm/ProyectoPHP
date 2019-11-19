<?php
  session_start();
  $Usuario = $_SESSION['Usuario'];
 ?>

<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Juan Sebastian González">
        <meta name="author" content="Nicolás Suárez">
        <link href="styles.css" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Crear Cuenta de Ahorros</title>
  </head>
  <body>
    <?php include('header.php')?>


    <div class=" text-center " style="display:flex; justify-content:center">
      <div class="form-signin">
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
    </div>
  </body>
</html>
