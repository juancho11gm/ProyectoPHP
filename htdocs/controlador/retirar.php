 <?php   
    session_start();
    $Id = $_SESSION['IdCuenta'];
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    $sql = "SELECT * FROM CuentasAhorros WHERE Id ='$Id' ;";
    $arreglo = mysqli_query($con,$sql);
    $row = mysqli_fetch_array( $arreglo);
    $saldoRetirar = $_POST['saldoRetirar'];
    if($row['Saldo']>=$saldoRetirar){
        $x = $row['Saldo'] - $saldoRetirar;
        $sql = "UPDATE CuentasAhorros SET Saldo = '$x' WHERE Id=".$Id.";";
        if (mysqli_query($con, $sql)) {
            $_SESSION['respuesta'] = 'Se ha retirado exitosamente';     
        }
        else {
            $_SESSION['respuesta'] = 'No se ha podido retirar.';        }
    }else{
        $_SESSION['respuesta'] = 'Saldo insuficiente.';        
    }
    header('Location: ../vista/cuentaahorros.php');

    
?>