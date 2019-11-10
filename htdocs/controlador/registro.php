<?php
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    $usuario = $_POST['username'];
    $contra = $_POST['password'];
    $contrasena = password_hash($contra,PASSWORD_DEFAULT);
    $sql= "SELECT * from Clientes where Usuario = '$usuario'";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query)!=0)
    {
        echo "El usuario ya existe";
    }
    else{
            $sql3 = "INSERT INTO Clientes (Usuario,Contrasena,Rol)
            VALUES ('$usuario','$contrasena','Usuario')";
            $registrar_usuario = mysqli_query($con,$sql3);
            if(!$registrar_usuario){
                die('No es posible registrar el usuario'.mysqli_error($con));
            }else{
                header('Location: ../index.php');
            }
        }

?>