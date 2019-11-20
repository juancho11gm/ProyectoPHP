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
    <meta name="author" content="Juan Sebastian González">
    <meta name="author" content="Nicolás Suárez">
    <link href="styles.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Retirar de Cuenta de Ahorros</title>
    <style>
        .body{            justify-content:center;
        }
    </style>
  </head>
  <body>
    <?php include('header.php')?>


    <div class="container text-center">
      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Ingresar el saldo a retirar en JaveCoins.</h1>
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
