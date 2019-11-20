<?php 
session_start();
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


//pago de créditos invitados

$sql = "SELECT * FROM Creditos WHERE Invitado IS NOT NULL;";
$query = mysqli_query($con,$sql);
$creditosinvitados = mysqli_fetch_all( $query);

foreach($creditosinvitados as $c){
    $date_now = date("Y-m-d");
    if($c[6] >= $date_now ){

        if($c[1]>0){

            include_once('../controlador/envioCorreo.php');
            $para = $c[7];
            $tema = 'Crédito con el ID '.$c[0];
            $contenido = 'No ha pagado su crédito, se le cobrarán intereses de mora.';
            $redireccion = 'administrador.php';

            $c[1] +=  ($c[1]*$c[2])/100;
            $sql = "UPDATE  Creditos SET Monto='$c[1]' WHERE Id = '$c[0]'";
            $query = mysqli_query($con,$sql);
            envioCorreo($para,$tema,$contenido,$redireccion);


        }
    }

}



//pago de tarjeta



//cobrar cuotas de manejo

$sql = "SELECT * FROM Tarjetas;";
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
        while($t[4]>0){ //$t[1]>0
            $cuentaactual =  $cuentascliente[$cuentaactualID];

            if($cuentaactual[1] >= $t[4]){
                $cuentaactual[1]-= $t[4];

                $sql = "UPDATE Tarjetas SET CuotaManejo=0 WHERE Id='$t[0]' ";
                $query = mysqli_query($con,$sql);

                $sql = "UPDATE  CuentasAhorros SET Saldo='$cuentaactual[1]' WHERE Id = '$cuentaactual[0]'";
                $query = mysqli_query($con,$sql);

                $sql = "INSERT INTO Movimientos (Valor, Origen,Destino,Tipo ) VALUES ('$t[4]',0,'$cuentaactual[0]','Pago de la cuota de manejo t $t[0]');";
                $query = mysqli_query($con,$sql);

                $t[4] = 0;


            }else{
                $cuentaactualID++;
                $t[4] -= $cuentaactual[1];

                $sql = "UPDATE Tarjetas SET CuotaManejo='$t[4]' WHERE Id='$t[0]' ";
                $query = mysqli_query($con,$sql);

                $sql = "UPDATE  CuentasAhorros SET Saldo=0 WHERE Id = '$cuentaactual[0]'";
                $query = mysqli_query($con,$sql);

                if($cuentaactual[1]>0){
                    $sql = "INSERT INTO Movimientos (Valor, Origen,Destino,Tipo ) VALUES ('$cuentaactual[1]',0,'$cuentaactual[0]','Pago de la cuota de manejo t $t[0]');";
                    $query = mysqli_query($con,$sql);
                }
               
                $cuentaactual[1]=0;

            }
        }
    }
    $sql = "UPDATE Tarjetas SET CuotaManejo='$cuotaprovisional' WHERE Id='$t[0]' ";
    $query = mysqli_query($con,$sql);  
}

//Pago de intereses

$sql = "SELECT * FROM CuentasAhorros;";
$query = mysqli_query($con,$sql);
$cuentas = mysqli_fetch_all( $query);

foreach($cuentas as $c){
    $x=0;
    if( ($c[1] * $_SESSION['interes_global'] /100) >0){
        $x = ($c[1] * $_SESSION['interes_global']) /100;
        $sql = "INSERT INTO Movimientos (Valor, Origen,Destino,Tipo ) VALUES ('$x',0,'$c[0]','Pago de intereses');";
        $query = mysqli_query($con,$sql);
    }
    

    $c[1] += $x;
    $sql = "UPDATE  CuentasAhorros SET Saldo='$c[1]' WHERE Id = '$c[0]'";
    $query = mysqli_query($con,$sql);

}


$_SESSION['respuesta'] = 'Se simuló el fin de mes';

header('Location: ../vista/index.php');


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