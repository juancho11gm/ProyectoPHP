<?php
     session_start();
     include_once('../config/config.php');
     $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
     $idusuario = $_SESSION['Id'];
     $sql = "INSERT INTO Tarjetas (CupoMaximo,Sobrecupo,TasaInteres,CuotaManejo,Aprobada,ClienteId)
                VALUES ('0','0','0','0','N','$idusuario')";
             $consulta = mysqli_query($con,$sql);
             if(!$consulta){
                 die('No es posible solicitar la tarjeta'.mysqli_error($con));
             }else{
                 $_SESSION['respuesta']='Tarjeta solicitada';
                 header('Location: ../vista/tarjetacredito.php');
             }
         
 
?>