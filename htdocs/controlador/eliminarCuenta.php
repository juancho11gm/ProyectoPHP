<?php
    if($_GET){
        include_once('../config/config.php');
        $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
        $id = $_GET['id'];
        $sql = "DELETE FROM cuentasahorros WHERE id = '$id'";
        if(mysqli_query($con,$sql)){
            header('location:../vista/administrador.php');
        }else{
            echo "Error de eliminación";
        }
        

    }else{
        header('location:../vista/administrador.php');
    }
?>