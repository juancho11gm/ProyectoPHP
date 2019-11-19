
<?php
  session_start();
  include_once '../controlador/tarjetacredito.php';
  include_once('../config/config.php');
  $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
  $compras = array();
  if(isset($_SESSION['Usuario'])){
      $Usuario = $_SESSION['Usuario'];
      if($_SESSION['Rol']=="Usuario"){
          $id = $_SESSION['Id'];
          $sql = "SELECT * FROM Tarjetas WHERE ClienteId ='$id'";

          $sql2 = "SELECT Compras.Id, Compras.Valor, Compras.Cuotas, Tarjetas.Id FROM Tarjetas INNER JOIN Compras ON Tarjetas.Id = Compras.TarjetaId INNER JOIN Clientes ON Tarjetas.ClienteId = Clientes.Id";
         
          $arreglo = mysqli_query($con,$sql2);
          while( $row = mysqli_fetch_array( $arreglo)){
              $compras[]=$row; // Inside while loop
          }
      }
      if($_SESSION['Rol']=="Administrador"){
          $sql = "SELECT * FROM Tarjetas";
      }
  }

  $query = mysqli_query($con,$sql);
  $tarjetas = mysqli_fetch_all($query);

 

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
    <title>Tus tarjetas de crédito</title>
  </head>
  
  <body>
    <?php include('header.php')?>


    <h1 class="title">Tarjetas de Crédito</h1>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
          
      <div class="container form-signin">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Cupo máximo</th>
              <th scope="col">Sobrecupo</th>
              <th scope="col">Tasa de Interés</th>
              <th scope="col">Cuota de manejo</th>
              <th scope="col">Aprobada</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($tarjetas as $t):?>
                <tr>
                    <td><?php echo number_format($t[0],0)?></td>
                    <td><?php echo number_format($t[1],2)?></td>
                    <td><?php echo number_format($t[2],2)?></td>
                    <td><?php echo number_format($t[3],2)?></td>
                    <td><?php echo number_format($t[4],2)?></td>
                    <td><?php echo $t[5]?></td>
                    <td>

                    <?php if($_SESSION['Rol']=='Administrador'):?>
                            <?php if($t[5] == 'N'):?>
                              <a href="../controlador/aprobartarjeta.php?IdTarjeta=<?php echo $t[0]?>" class="btn btn-link">Aprobar</a>
                            <?php endif?>
                            <a href="actualizarTarjeta.php?Id=<?php echo $t[0]?>" class="btn btn-outline-success">Editar</a>
                    <?php endif?>

                              <a href="../controlador/eliminarTarjeta.php?Id=<?php echo $t[0]?>" class="btn btn-outline-danger">Eliminar</a>
                            </td>

                </tr>
                <?php endforeach?>
          </tbody>
        </table>
        <?php if($_SESSION['Rol']!='Administrador'):?>
        <div class="container">
            <div class="row">
              <div class="col-6">
                  <p><a class="btn btn-success btn-block" href="../controlador/solicitartarjeta.php" role="button" >Solicitar Tarjeta</a></p>
              </div>
              <div class="col-6">
                    <p><a class="btn btn-success btn-block" href="./comprar.php" role="button">Comprar </a></p>
              </div>
            </div>
          </div>
        <?php endif?>
        </div>
      </div>
    </div>


    <h1 class="title">Compras</h1>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
          
      <div class="container form-signin">
        <table class="table">
          <thead>
            <tr>
            <th scope="col">Id compra</th>
              <th scope="col">Valor</th>
              <th scope="col">Cuotas</th>
              <th scope="col">Id tarjeta</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($compras as $c):?>

            <tr>
                    <td><?php echo $c[0]?></td>
                    <td><?php echo $c[1]?></td>
                    <td><?php echo $c[2]?></td>
                    <td><?php echo $c[3]?></td>

            </tr>
          <?php endforeach?>
          </tbody>
        </table>
      </div>
    </div>    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
