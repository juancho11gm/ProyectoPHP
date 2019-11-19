<?php 

    session_start();
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    if($_POST){
        $saldo = $_POST['saldo'];
        $id = $_POST['id'];
    

        $sql = "UPDATE Cuentasahorros SET  Saldo ='$saldo'   WHERE Id = '$id';";

        if(!mysqli_query($con,$sql)){
            die('No es posible actualizar la cuenta'.mysqli_error($con));
            $_SESSION['respuesta'] = 'No se ha podido actualizar la cuenta';
            
        }else{
            $_SESSION['respuesta'] = 'Se ha actualizado la cuenta exitosamente';     
            header('Location: ../vista/cuentaahorros.php');
        }

    }
?>