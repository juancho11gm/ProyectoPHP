<?php
    if($_GET){
        include_once('../config/config.php');
        $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
        $id = $_GET['Id'];
        $sql = "DELETE FROM Tarjetas WHERE id = '$id'";
        if(mysqli_query($con,$sql)){
            if($_SESSION['Rol']=='Administrador'){
                header('location:../vista/administrador.php');
            }else{
                header('location:../vista/tarjetacredito.php');

            }
        }else{
            echo "Error de eliminación";
        }
        

    }else{
        if($_SESSION['Rol']=='Administrador'){
            header('location:../vista/administrador.php');
        }else{
            header('location:../vista/tarjetacredito.php');

        }    }
?>