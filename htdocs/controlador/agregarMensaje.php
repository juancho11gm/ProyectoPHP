<?php
    session_start();
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    if($_POST){
        $mensaje = $_POST['mensaje'];
        $Usuario = $_SESSION['Usuario'];
        if($_SESSION['Rol']=='Administrador'){
            $Usuario = "Administrador: $Usuario";
        }
        $id = $_POST['id'];
        $hora = date('H:i');    
        $rol = $_SESSION['Rol'];
        $sql = "INSERT INTO Mensaje (IdChat,Usuario,Texto,Hora,Rol) VALUES ('$id','$Usuario','$mensaje','$hora','$rol');";
        
        if(!mysqli_query($con,$sql)){
            die('No es posible registrar el credit'.mysqli_error($con));
            $_SESSION['respuesta'] = 'No se ha podido crear la cuenta';
      
        }else{
            $_SESSION['respuesta'] = 'Se ha creado la cuenta exitosamente exitosamente';     
            header('Location: ../vista/mensajes.php?id='.$id);
        }

    }
?>