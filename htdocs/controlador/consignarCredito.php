<?php
  session_start();
  include_once('../config/config.php');
  $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
  $origen=$_POST['origencredito'];
  $destino=$_POST['destinocredito'];
  echo $origen." ".$destino;
  
  if($_POST['tipomonedacredito']=='0'){
     $monto = $_POST['montocredito']/1000;
  }else{
    $monto = $_POST['montocredito'];
  }


    $sql = "SELECT * FROM CuentasAhorros WHERE Id ='$origen';";
    $arreglo = mysqli_query($con,$sql);
    $row = mysqli_fetch_array( $arreglo);
    echo "SALDO ".$row['Saldo']."---Monto ".$monto;
    if($row['Saldo']>=$monto){
        $x = $row['Saldo'] - $monto;
        $sql = "UPDATE CuentasAhorros SET Saldo = '$x' WHERE Id=".$origen.";";
        
        if (mysqli_query($con, $sql)) {
            $sql = "SELECT * FROM Creditos WHERE Id ='$destino';";
            $arreglo = mysqli_query($con,$sql);
            $row = mysqli_fetch_array( $arreglo);


            $x = $row['Monto'] - $monto;
            $sql = "UPDATE Creditos SET Monto = '$x' WHERE Id=".$destino.";";

            if (mysqli_query($con, $sql)) {
                $_SESSION['respuesta'] = 'Se ha consignado exitosamente';

                $sql = "INSERT INTO Movimientos (Valor, Origen,Destino,Tipo ) VALUES ('$monto','$origen','$destino','Cuenta consigna a crédito');";
                mysqli_query($con, $sql);
            }
        }       

    }else{
        $_SESSION['respuesta'] = 'La cuenta de origen no tiene el saldo suficiente';
        echo 'La cuenta de origen no tiene el saldo suficiente';
    }
  
  header('Location: ../vista/cuentaahorros.php');

?>