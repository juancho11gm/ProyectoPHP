<?php
  session_start();
  $Usuario = $_SESSION['Usuario'];
  $Id = $_GET['IdCuenta'];
  $_SESSION['IdCuenta']= $_GET['IdCuenta'];

  include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    $sql = "SELECT * FROM CuentasAhorros WHERE Id ='$Id' ;";
    $arreglo = mysqli_query($con,$sql);
    $new_array = array();
    $row = mysqli_fetch_array( $arreglo);
 ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Retirar de Cuenta de Ahorros</title>
    <style>
        .body{            justify-content:center;
        }
    </style>
  </head>
  <body>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-2 text-dark" ><?php echo $Usuario; ?></a>
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
        <h1 class="display-4">Ingresar el saldo a retirar.</h1>
        </div>
      <form class="form" action="../controlador/retirar.php" method="post">
        <div >
          <div >
            <label >Saldo Actual</label>
            <label >$<?php echo number_format($row['Saldo'],2); ?> JaverCoins </label><br>
            <label >Saldo a retirar</label>
            <input type="number" name="saldoRetirar" class="form-control"  placeholder="Saldo en JaveCoins" required><br>
            <button type="submit" class="submit-btn btn btn-success">Retirar</button>

          </div>
        </div>
      </form>
    </div>
  </body>
</html>
