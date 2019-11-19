<?php 

    session_start();
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    if($_POST){
        $cupo = $_POST['cupomaximo'];
        $sobrecupo = $_POST['sobrecupo'];
        $id = $_POST['id'];
        $tasa = $_POST['tasa'];
        $cuota = $_POST['cuotamanejo'];
        $aprobado = $_POST['aprobado'];
        $sql = "UPDATE Tarjetas SET  CupoMaximo = '$cupo', Sobrecupo = '$sobrecupo', TasaInteres = '$tasa', CuotaManejo ='$cuota', Aprobada ='$aprobado'  WHERE Id = '$id';";
        
        if(!mysqli_query($con,$sql)){
            die('No es posible guardar la tarjeta'.mysqli_error($con));
            $_SESSION['respuesta'] = 'No es posible guardar la tarjeta';
            
        }else{
            $_SESSION['respuesta'] = 'Se ha actualizado la tarjeta exitosamente';     
            header('Location: ../vista/tarjetacredito.php');
        }

    }
?>