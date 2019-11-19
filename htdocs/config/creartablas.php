<?php
    include_once('./config.php');
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
    $sql = "CREATE TABLE Clientes (Id INT(11) NOT NULL AUTO_INCREMENT,Usuario VARCHAR(30),Contrasena VARCHAR(200),Rol VARCHAR(30),UNIQUE(Usuario), PRIMARY KEY (Id))";
    if (mysqli_query($con, $sql)) {
        echo "Tabla Clientes creada";
    } else {
        echo "Error" . mysqli_error($con);
    }
    $sql = "CREATE TABLE Invitados ( Email VARCHAR(30) NOT NULL,Cedula INT(10) NOT NULL, PRIMARY KEY (Email));";
    if (mysqli_query($con, $sql)) {
        echo "Tabla Invitados creada";
    } else {
        echo "Error" . mysqli_error($con);
    }
    $sql = "CREATE TABLE CuentasAhorros (Id INT(11) NOT NULL AUTO_INCREMENT,Saldo decimal(40,10) NOT NULL, ClienteId INT(11),PRIMARY KEY (Id),FOREIGN KEY (ClienteId) REFERENCES Clientes(Id) ON DELETE CASCADE);";
    if (mysqli_query($con, $sql)) {
        echo "Tabla CuentasAhorros creada";
    } else {
        echo "Error" . mysqli_error($con);
    }
    
    $sql = "CREATE TABLE Tarjetas (Id INT(11) NOT NULL AUTO_INCREMENT,CupoMaximo decimal(40,2),Sobrecupo decimal(40,2),TasaInteres decimal(40,2),CuotaManejo decimal(40,2),Aprobada VARCHAR(30), ClienteId INT(11),PRIMARY KEY (Id),FOREIGN KEY (ClienteId) REFERENCES Clientes(Id) ON DELETE CASCADE);";
    if (mysqli_query($con, $sql)) {
        echo "Tabla Tarjetas creada";
    } else {
        echo "Error" . mysqli_error($con);
    }

    $sql = "CREATE TABLE Creditos (Id INT(11) NOT NULL AUTO_INCREMENT,Monto decimal(40,2) NOT NULL,TasaInteres decimal(40,2),CuotaManejo decimal(40,2),Aprobada VARCHAR(30), ClienteId INT(11),FechaPago DATE, Invitado VARCHAR(30), PRIMARY KEY (Id),FOREIGN KEY (ClienteId) REFERENCES Clientes(Id) ON DELETE CASCADE);";
    if (mysqli_query($con, $sql)) {
        echo "Tabla Créditos creada";
    } else {
        echo "Error" . mysqli_error($con);
    }

    $sql = "CREATE TABLE DatosBasicos (Id INT(11) NOT NULL AUTO_INCREMENT,Monto decimal(40,2) NOT NULL,TasaInteres decimal(40,2),CuotaManejo decimal(40,10) ,PRIMARY KEY (Id));";
    if (mysqli_query($con, $sql)) {
        echo "Tabla DatosBasicos creada";
    } else {
        echo "Error" . mysqli_error($con);
    }

    $sql = "CREATE TABLE Compras (Id INT(11) NOT NULL AUTO_INCREMENT,Valor decimal(40,2) NOT NULL,Cuotas INT(11) ,TarjetaId INT(11), PRIMARY KEY (Id), FOREIGN KEY (TarjetaId) REFERENCES Tarjetas(Id) ON DELETE CASCADE);";
    if (mysqli_query($con, $sql)) {
        echo "Tabla Compras creada";
    } else {
        echo "Error" . mysqli_error($con);
    }

?>