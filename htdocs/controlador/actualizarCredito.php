<?php 

    session_start();
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    if($_POST){
        $tasa = $_POST['tasa'];
        $cuotas = $_POST['cuotas'];
        $id = $_POST['id'];
        $monto = $_POST['monto'];
        $fecha = $_POST['fechaPago'];
        $aprobado = $_POST['aprobado'];
        $sql = "UPDATE Creditos SET TasaInteres = '$tasa', CuotaManejo = '$cuotas', Monto = '$monto', Aprobada ='$aprobado', FechaPago = '$fecha' WHERE Id = '$id';";
        
        if(!mysqli_query($con,$sql)){
            die('No es posible registrar el credit'.mysqli_error($con));
            $_SESSION['respuesta'] = 'No se ha podido crear la cuenta';
            
        }else{
            $_SESSION['respuesta'] = 'Se ha creado la cuenta exitosamente exitosamente';     
            header('Location: ../vista/creditos.php');
        }

    }
?>