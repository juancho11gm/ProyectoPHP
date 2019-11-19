  
<?php
  session_start();
  include_once('../config/config.php');
  $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
  $saldo =$_POST['saldo'];
  $identificador = $_SESSION['Id'];
  $sql = "INSERT INTO CuentasAhorros (Saldo,ClienteId) VALUES ('$saldo','$identificador') ;";
  $x = mysqli_query($con,$sql);
  if(!$x){
      die('No es posible registrar el usuario'.mysqli_error($con));
      $_SESSION['respuesta'] = 'No se ha podido crear la cuenta';
      header('Location: ../vista/cuentaahorros.php');


  }else{
      $_SESSION['respuesta'] = 'Se ha creado la cuenta exitosamente exitosamente';     

        $sql = "SELECT * FROM CuentasAhorros  WHERE ClienteId='$identificador' ORDER BY ID DESC LIMIT 1;";

        $query = mysqli_query($con,$sql);
        $idcuenta = mysqli_fetch_all($query);

        foreach($idcuenta as $c){
          $sql = "INSERT INTO Movimientos (Valor, Origen,Destino,Tipo ) VALUES ('$saldo',0,'$c[0]','Creación de la cuenta');";

        }
      mysqli_query($con, $sql);
      header('Location: ../vista/cuentaahorros.php');

  }
?>
  