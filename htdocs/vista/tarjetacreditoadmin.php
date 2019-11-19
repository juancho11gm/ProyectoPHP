
<?php
  session_start();
  include_once '../controlador/tarjetacredito.php';
  $credit_cards = $_SESSION['TodasTarjetasCredito'];
  $Usuario = ($_SESSION['Usuario']);
  $respuesta='';
  if(isset($_SESSION['respuesta'])) {
    $respuesta .= '<script> alert("' .$_SESSION['respuesta']. '")</script>';
    echo $respuesta;
    unset($_SESSION['respuesta']);
  }
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

    <title>Tarjetas de crédito</title>
  </head>
  <body>
    <?php include('header.php')?>
 

    <h1 class="title">Tarjetas de crédito</h1>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <div class="container form-signin">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Monto</th>
              <th scope="col">Cupo máximo</th>
              <th scope="col">Sobrecupo</th>
              <th scope="col">Cuota de manejo</th>
              <th scope="col">Tasa de Interés</th>
              <th scope="col">Aprobada</th>
              <th scope="col">Aprobar</th>
  
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($credit_cards as $key) {
                  echo '<tr>';
                    echo '<th>'.$key['Id']."</th>";
                    echo "<td> $ ".number_format($key['Monto'],2)." JaveCoins </td>";
                    echo "<td>".number_format($key['CupoMaximo'],2)."</td>";
                    echo "<td>".number_format($key['Sobrecupo'],2)."</td>";
                    echo "<td>".number_format($key['TasaInteres'],2)."</td>";
                    echo "<td>".number_format($key['CuotaManejo'],2)."</td>";
                    echo '<th>'.$key['Aprobada']."</th>";
                    if($key['Aprobada']=='N'){
                      echo "<td><a class=option-btn btn btn-warning href=../controlador/aprobartarjeta.php?IdTarjeta=".$key['Id'].">Aprobar</a></td>";
                    }
                  echo '</tr>';
              }
            ?>
          </tbody>
        </table>
        <!--<div class="container">
            <div class="row">
              <div class="col-6">
                  <p><a class="btn btn-success btn-block" href="../controlador/solicitartarjeta.php" role="button" >Solicitar Tarjeta</a></p>
              </div>
              <div class="col-6">
                    <p><a class="btn btn-success btn-block" href="./comprar.php" role="button">Comprar </a></p>
              </div>
            </div>
          </div>
        </div>-->

      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
