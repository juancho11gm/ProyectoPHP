<?php
    include_once('./config.php');
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
    $sql = "CREATE TABLE Clientes (Id INT(11) NOT NULL AUTO_INCREMENT,Usuario VARCHAR(30),Contrasena VARCHAR(200),Rol VARCHAR(30),UNIQUE(Usuario), PRIMARY KEY (Id))";
    if (mysqli_query($con, $sql)) {
        echo "Tabla Clientes creada";
    } else {
        echo "Error" . mysqli_error($con);
    }
    $sql = "CREATE TABLE Invitados ( Email VARCHAR(30) NOT NULL,Cedula int NOT NULL, PRIMARY KEY (Email));";
    if (mysqli_query($con, $sql)) {
        echo "Tabla Invitados creada";
    } else {
        echo "Error" . mysqli_error($con);
    }
   

?>