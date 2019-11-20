<?php 
echo "hola";
include_once('../config/config.php');
$con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);

//pagar créditos

$sql = "SELECT * FROM Creditos;";
$query = mysqli_query($con,$sql);
$creditos = mysqli_fetch_all( $query);

$sql = "SELECT * FROM CuentasAhorros;";
$query = mysqli_query($con,$sql);
$cuentas = mysqli_fetch_all( $query);

foreach($creditos as $c){
    $saldototacliente = getSaldoTotal($c[5]);//id    saldo total créditos
    if($saldototacliente >= $c[1]){//monto
        $sql = "SELECT * FROM CuentasAhorros where ClienteId = '$c[5]'";
        $query = mysqli_query($con,$sql);
        $cuentascliente = mysqli_fetch_all($query);
        $cuentaactualID=0;
        while($c[1]>0){ //$c[1]>0
            $cuentaactual =  $cuentascliente[$cuentaactualID];

            if($cuentaactual[1] >= $c[1]){
                $cuentaactual[1]-= $c[1];

                $sql = "UPDATE Creditos SET Monto=0 WHERE Id='$c[0]' ";
                $query = mysqli_query($con,$sql);

                $sql = "UPDATE  CuentasAhorros SET Saldo='$cuentaactual[1]' WHERE Id = '$cuentaactual[0]'";
                $query = mysqli_query($con,$sql);

                $sql = "INSERT INTO Movimientos (Valor, Origen,Destino,Tipo ) VALUES ('$c[1]',0,'$cuentaactual[0]','Pago del crédito $c[0]');";
                $query = mysqli_query($con,$sql);

                $c[1] = 0;

            }else{
                $cuentaactualID++;
                $c[1] -= $cuentaactual[1];

                $sql = "UPDATE Creditos SET Monto='$c[1]' WHERE Id='$c[0]' ";
                $query = mysqli_query($con,$sql);

                $sql = "UPDATE  CuentasAhorros SET Saldo=0 WHERE Id = '$cuentaactual[0]'";
                $query = mysqli_query($con,$sql);

                if($cuentaactual[1]>0){
                    $sql = "INSERT INTO Movimientos (Valor, Origen,Destino,Tipo ) VALUES ('$cuentaactual[1]',0,'$cuentaactual[0]','Pago del crédito $c[0]');";
                    $query = mysqli_query($con,$sql);
                }
               

                $cuentaactual[1]=0;

            }
        }
    }  

}

//cobrar cuotas de manejo

$sql = "SELECT * FROM Tarjetas where Aprobada='S';";
$query = mysqli_query($con,$sql);
$tarjetas = mysqli_fetch_all( $query);

foreach($tarjetas as $t){
    $saldototacliente = getSaldoTotal($t[6]);//id - saldo total tarjetas  
    $cuotaprovisional = $t[4];
    if($saldototacliente >= $t[4]){//monto
        $sql = "SELECT * FROM CuentasAhorros where ClienteId = '$t[6]'";
        $query = mysqli_query($con,$sql);
        $cuentascliente = mysqli_fetch_all($query);
        $cuentaactualID=0;
        while($t[4]>0){ //$c[1]>0
            $cuentaactual =  $cuentascliente[$cuentaactualID];

            if($cuentaactual[1] >= $t[4]){
                echo "holasi";
                $cuentaactual[1]-= $t[4];

                $sql = "UPDATE Tarjetas SET CuotaManejo=0 WHERE Id='$t[0]' ";
                $query = mysqli_query($con,$sql);

                $sql = "UPDATE  CuentasAhorros SET Saldo='$cuentaactual[1]' WHERE Id = '$cuentaactual[0]'";
                $query = mysqli_query($con,$sql);

                $sql = "INSERT INTO Movimientos (Valor, Origen,Destino,Tipo ) VALUES ('$t[4]',0,'$cuentaactual[0]','Pago de la cuota de manejo de la tarjeta $t[0]');";
                $query = mysqli_query($con,$sql);

                $t[4] = 0;


            }else{
                echo "holano";
                $cuentaactualID++;
                $t[4] -= $cuentaactual[1];

                $sql = "UPDATE Tarjetas SET CuotaManejo='$t[4]' WHERE Id='$t[0]' ";
                $query = mysqli_query($con,$sql);

                $sql = "UPDATE  CuentasAhorros SET Saldo=0 WHERE Id = '$cuentaactual[0]'";
                $query = mysqli_query($con,$sql);

                if($cuentaactual[1]>0){
                    $sql = "INSERT INTO Movimientos (Valor, Origen,Destino,Tipo ) VALUES ('$cuentaactual[1]',0,'$cuentaactual[0]','Pago de la cuota de manejo de la tarjeta $t[0]');";
                    $query = mysqli_query($con,$sql);
                }
               
                $cuentaactual[1]=0;

            }
        }
        $sql = "UPDATE Tarjetas SET CuotaManejo='$cuotaprovisional' WHERE Id='$t[0]' ";
        $query = mysqli_query($con,$sql);  
    }
    
}

//header('Location: ../vista/index.php');



function getSaldoTotal($idcliente){
    include_once('../config/config.php');
$con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    $sql = "SELECT Sum(Saldo) FROM CuentasAhorros where ClienteId='$idcliente';";
    $query = mysqli_query($con,$sql);
    $saldo = mysqli_fetch_array( $query);
    return $saldo[0];

}

function getSaldoTotalTarjetas($idcliente){
    include_once('../config/config.php');
$con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    $sql = "SELECT Sum(CuotaManejo) FROM Tarjetas where ClienteId='$idcliente';";
    $query = mysqli_query($con,$sql);
    $saldo = mysqli_fetch_array( $query);
    return $saldo[0];

}

?>