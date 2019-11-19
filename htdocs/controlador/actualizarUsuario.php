<?php 

    session_start();
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    if($_POST){
        $usuario = $_POST['usuario'];
        $id = $_POST['id'];
    

        $sql = "UPDATE Clientes SET  Usuario ='$usuario'   WHERE Id = '$id';";

        if(!mysqli_query($con,$sql)){
            die('No es posible actualizar el usuario'.mysqli_error($con));
            $_SESSION['respuesta'] = 'No se ha podido actualizar el usuario';
            
        }else{
            $_SESSION['respuesta'] = 'Se ha actualizado el usuario exitosamente';     
            header('Location: ../vista/tarjetacredito.php');
        }

    }
?>