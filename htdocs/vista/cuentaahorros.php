  <?php
  session_start();
  include_once('../config/config.php');
  $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
  $sql = "SELECT * FROM CuentasAhorros WHERE ClienteId =".$_SESSION['Id'].";";
  $arreglo = mysqli_query($con,$sql);
  $new_array = array();
  while( $row = mysqli_fetch_array( $arreglo)){
      $new_array[]=$row; // Inside while loop
  }
  $_SESSION['CuentasAhorros'] = $new_array;
  $Usuario = ($_SESSION['Usuario']);


  $sql = "SELECT * FROM CuentasAhorros;";
  $arreglo = mysqli_query($con,$sql);
  $new_array = array();
  while( $row = mysqli_fetch_array( $arreglo)){
      $new_array[]=$row; // Inside while loop
  }
  $_SESSION['TodasCuentasAhorros'] = $new_array;


  $sql = "SELECT * FROM Creditos WHERE Aprobada = 'S' ;";
  $arreglo = mysqli_query($con,$sql);
  $new_array = array();
  while( $row = mysqli_fetch_array( $arreglo)){
      $new_array[]=$row; // Inside while loop
  }
  $creditos = $new_array;


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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Juan Sebastian González">
    <meta name="author" content="Nicolás Suárez">
    <link href="styles.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Cuenta de ahorros</title>  
  </head>

  <body>
  <?php include('header.php')?>


    <h1 class="title">Cuentas de ahorros</h1>
    <div class="container form-signin">
      <div class="cuentas ">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Saldo</th>
              <th scope="col">Retirar</th>

            </tr>
          </thead>
          <tbody>
            <?php

              if(sizeof( $_SESSION['CuentasAhorros'])>0){
                foreach ( $_SESSION['CuentasAhorros'] as $key) {
                  echo '<tr>';
                  echo '<th >'.$key['Id']."</th>";
                  echo "<td> $ ".number_format($key['Saldo'],2)." JaveCoins </td> ";
                  echo " <td> <a class=option-btn btn btn-warning href=./retirar.php?IdCuenta=".$key['Id']." >Retirar </a></td>";
                  echo '</tr>';
                }
              }
          ?>
         <?php if($_SESSION['Rol'] == 'Administrador'):?>

              <?php foreach($_SESSION['TodasCuentasAhorros'] as $c):?>
                <tr>
                    <td><?php echo $c[0];?></td>
                    <td><?php echo $c[1];?></td>
                    <td><?php echo $c[2];?></td>
                    <td>
                        <a href="./actualizarCuentaahorros.php?Id=<?php echo $c[0]?>" class="btn btn-outline-success">Editar</a>
                        <a href="../controlador/eliminarCuenta.php?id=<?php echo $c[0]?>" class="btn btn-outline-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>              
            <?php endif?>

          </tbody>
        </table>
      </div>
      <?php if($_SESSION['Rol'] != 'Administrador'):?>
      <div class="botones">
        <a class="option-btn btn btn-success" href="./crearCuentaAhorros.php">Crear cuenta de ahorros</a>
      </div>
      <?php endif?>
    </div>
    <br>
    <?php if($_SESSION['Rol'] != 'Administrador'):?>
    <div class="consignar " style="display:flex; justify-content:space-around">
        <div class="row form-signin">
          <h3 clas="title">Consignar a cuenta </h3>
          <form class="container " action="../controlador/consignar.php" method="post">
            <label >Cuenta de Ahorros Origen</label>
            <select name="origen" class="form-control" id="origin" required>
              <?php
                foreach ( $_SESSION['CuentasAhorros'] as $key ) {
                  echo '<option>'.$key['Id'].'</option>';
                }
              ?>
              <option>Sin cuenta</option>
            </select>
            <label for="amount">Monto a Consignar</label>
            <input type="number" name="monto" id="amount" min=0 onkeyup="replaceSpecialCharactersNumber(this)" placeholder="Monto" class="form-control" required>
            <div class="row">
              <div class="col-6">
                <div class="form-check text-center">
                  <input class="form-check-input" type="radio" name="tipomoneda" id="exampleRadios1" value="0">
                  <label class="form-check-label">
                    Pesos
                  </label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check text-center">
                  <input class="form-check-input" type="radio" name="tipomoneda" id="exampleRadios2" value="1" checked>
                  <label class="form-check-label" >
                    JaveCoins
                  </label>
                </div>
              </div>
            </div>
            <label >Cuenta de Destino</label>

            <select name="destino" class="form-control" id="origin" required>
              <?php
                foreach ($_SESSION['TodasCuentasAhorros'] as $key ) {
                  echo '<option>'. $key['Id'] .'</option>';
                }
              ?>
            </select><br>
              <button type="submit" class="submit-btn btn btn-outline-success btn-block">Consignar</button>
          </form>
        </div>

        <div class="row form-signin">
          <h3 clas="title">Consignar a crédito </h3>
          <form class="container " action="../controlador/consignarCredito.php" method="post">
            <label >Cuenta de Ahorros Origen</label>
            <select name="origencredito" class="form-control" id="origin" required>
              <?php
                foreach ( $_SESSION['CuentasAhorros'] as $key ) {
                  echo '<option>'.$key['Id'].'</option>';
                }
              ?>
            </select>
            <label for="amount">Monto a Consignar</label>
            <input type="number" name="montocredito" id="amount" min=0 onkeyup="replaceSpecialCharactersNumber(this)" placeholder="Monto" class="form-control" required>
            <div class="row">
              <div class="col-6">
                <div class="form-check text-center">
                  <input class="form-check-input" type="radio" name="tipomonedacredito" id="exampleRadios1" value="0">
                  <label class="form-check-label">
                    Pesos
                  </label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check text-center">
                  <input class="form-check-input" type="radio" name="tipomonedacredito" id="exampleRadios2" value="1" checked>
                  <label class="form-check-label" >
                    JaveCoins
                  </label>
                </div>
              </div>
            </div>
            <label >Crédito de Destino</label>

            <select name="destinocredito" class="form-control" id="origin" required>
              <?php
                foreach ($creditos as $key ) {
                  echo '<option>'. $key['Id'] .'</option>';
                }
              ?>
            </select><br>
              <button type="submit" class="submit-btn btn btn-outline-success btn-block">Consignar</button>
          </form>
        </div>
    </div>
    <?php endif?>


    <script>
      function replaceSpecialCharactersNumber(e){
        e.value = e.value.split(/[`~!@#$%^&*()_|+\-¿¡=?°¬;:'e",.<>\{\}\[\]\\\/]/gi).join(""); 
        e.value = e.value.split(" ").join("");
      }
    </script>
  </body>
</html>