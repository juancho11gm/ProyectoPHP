<?php 

    session_start();
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    if($_POST){
        $idtarjeta = $_POST['tarjetaid'];
        $valor = $_POST['valor'];
        $cuotas= $_POST['cuotas'];
        $sql = "INSERT INTO Compras (Valor,Cuotas,TarjetaId)
                   VALUES ('$valor','$cuotas','$idtarjeta')";
                    $consulta = mysqli_query($con,$sql);
                    if(!$consulta){
                        die('No es posible realizar la compra'.mysqli_error($con));
                        $_SESSION['respuesta']='No es posible realizar la Compra';
                    }else{
                        $_SESSION['respuesta']='Compra realizada';
                        header('Location: ../vista/tarjetacredito.php');
                    }
    }

?>