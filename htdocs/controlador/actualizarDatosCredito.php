<?php 

    session_start();
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    if($_POST){
        $tasa = $_POST['interes'];
        $cuotas = $_POST['cuotas'];
        $id = $_POST['id'];

        $_SESSION['interes_global']=$tasa;
        $_SESSION['cuota_global']=$cuotas;


        $sql = "UPDATE DatosBasicos SET TasaInteres = '$tasa', CuotaManejo = '$cuotas' WHERE Id = '$id';";
        
        if(!mysqli_query($con,$sql)){
            die('No es posible registrar el credit'.mysqli_error($con));
            $_SESSION['respuesta'] = 'No se ha podido crear la cuenta';
            $sql = "INSERT INTO DatosBasicos (TasaInteres, CuotaManejo) VALUES ('$tasa','$cuotas');";
            if(mysqli_query($con,$sql)){
                header('Location: ../vista/administrador.php');
            }else{
                echo "Error Actualizando Datos";
            }
        }else{
            $_SESSION['respuesta'] = 'Se ha creado la cuenta exitosamente exitosamente';     
            header('Location: ../vista/administrador.php');
        }

    }
?>