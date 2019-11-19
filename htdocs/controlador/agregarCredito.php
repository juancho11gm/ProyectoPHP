<?php 
    session_start();
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    if($_POST){
        $monto = $_POST['monto'];
        $tasa = $_POST['tasa'];
        $cuotas = $_POST['cuotas'];
        $fecha = $_POST['fechaPago'];
        
        if(isset($_SESSION['Usuario'])){
            $id = $_SESSION['Id'];
            
            $sql = "INSERT INTO Creditos (Monto,TasaInteres, CuotaManejo,ClienteId,Aprobada, FechaPago) VALUES ('$monto','$tasa','$cuotas','$id','N','$fecha');";
        }
        if(isset($_SESSION['Email'])){
            $Email = $_SESSION['Email'];
            $sql = "INSERT INTO Creditos (Monto,TasaInteres, CuotaManejo,Invitado,Aprobada, FechaPago) VALUES ('$monto','$tasa','$cuotas','$Email','N','$fecha');";
        }
        
        if(!mysqli_query($con,$sql)){
            die('No es posible registrar el credit'.mysqli_error($con));
            $_SESSION['respuesta'] = 'No se ha podido crear la cuenta';
      
        }else{
            $_SESSION['respuesta'] = 'Se ha creado la cuenta exitosamente exitosamente';     
            header('Location: ../vista/creditos.php');
        }

    }
    
    

?>