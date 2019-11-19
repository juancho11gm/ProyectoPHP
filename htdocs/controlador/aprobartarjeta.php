<?php
    session_start();
    $Id = $_GET['IdTarjeta'];
    echo $Id;
    $aprobada="S";
    echo $aprobada;
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);

    $sql = "UPDATE Tarjetas SET Aprobada = 'S' WHERE Id = '$Id';";
        if (mysqli_query($con, $sql)) {
                $_SESSION['respuesta'] = 'Se ha aprobado exitosamente';     
        }
        else {
            $_SESSION['respuesta'] = 'No se ha podido aprobar.';       
        }
   
     header('Location: ../vista/administrador.php');

?>

