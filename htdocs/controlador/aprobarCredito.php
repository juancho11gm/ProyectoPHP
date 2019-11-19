<?php
    session_start();
    if($_GET){
        $Id = $_GET['Id'];
        echo $Id;
        $aprobada="S";
        echo $aprobada;
        include_once('../config/config.php');
        $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    
        $sql = "UPDATE Creditos SET Aprobada = 'S' WHERE Id = '$Id';";
            if (mysqli_query($con, $sql)) {
                    $_SESSION['respuesta'] = 'Se ha aprobado exitosamente';     
            }
            else {
                $_SESSION['respuesta'] = 'No se ha podido aprobar.';       
            }
       
         header('Location: ../vista/creditos.php');

    }

?>