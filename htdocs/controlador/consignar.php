<?php
  session_start();
  include_once('../config/config.php');
  $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
  $origen=$_POST['origen'];
  $destino=$_POST['destino'];
  $_POST['monto'];
  echo $origen." ".$destino;

  if($_POST['tipomoneda']=='0'){
     $monto = $_POST['monto']/1000;
  }else{
    $monto = $_POST['monto'];
  }

  if($origen=='Sin cuenta'){

    $sql = "SELECT * FROM CuentasAhorros WHERE Id ='$destino';";
    $arreglo = mysqli_query($con,$sql);
    $row = mysqli_fetch_array( $arreglo);
    $x = $row['Saldo'] + $monto;
    $sql = "UPDATE CuentasAhorros SET Saldo = '$x' WHERE Id=".$destino.";";
    if (mysqli_query($con, $sql)) {
        $_SESSION['respuesta'] = 'Se ha consignado exitosamente';
        echo 'Se ha consignado exitosamente';

        $sql = "INSERT INTO Movimientos (Valor, Origen,Destino,Tipo ) VALUES ('$monto',0,'$destino','Sin cuenta consigna a cuenta');";
        mysqli_query($con, $sql);
    }
    else {
        $_SESSION['respuesta'] = 'No se ha podido consignar.';
        echo 'No se ha podido consignar.';
    }
  }else{

    $sql = "SELECT * FROM CuentasAhorros WHERE Id ='$origen';";
    $arreglo = mysqli_query($con,$sql);
    $row = mysqli_fetch_array( $arreglo);

    if($row['Saldo']>=$monto){
        $x = $row['Saldo'] - $monto;
        $sql = "UPDATE CuentasAhorros SET Saldo = '$x' WHERE Id=".$origen.";";
        
        if (mysqli_query($con, $sql)) {
            $sql = "SELECT * FROM CuentasAhorros WHERE Id ='$destino';";
            $arreglo = mysqli_query($con,$sql);
            $row = mysqli_fetch_array( $arreglo);


            $x = $row['Saldo'] + $monto;
            $sql = "UPDATE CuentasAhorros SET Saldo = '$x' WHERE Id=".$destino.";";

            if (mysqli_query($con, $sql)) {
                $_SESSION['respuesta'] = 'Se ha consignado exitosamente';

                $sql = "INSERT INTO Movimientos (Valor, Origen,Destino,Tipo ) VALUES ('$monto','$origen','$destino','Cuenta consigna a cuenta');";
                mysqli_query($con, $sql);
            }
        }       

    }else{
        $_SESSION['respuesta'] = 'La cuenta de origen no tiene el saldo suficiente';
        echo 'La cuenta de origen no tiene el saldo suficiente';
    }
  }
  header('Location: ../vista/cuentaahorros.php');

?>