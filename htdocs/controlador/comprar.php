<?php 

    session_start();
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    if($_POST){
        $idtarjeta = $_POST['tarjetaid'];
        $valor = $_POST['valor'];
        $cuotas= $_POST['cuotas'];
        
        
        $sql2 = "SELECT SUM(Compras.Valor) FROM Tarjetas INNER JOIN Compras ON Tarjetas.Id = Compras.TarjetaId INNER JOIN Clientes ON Tarjetas.ClienteId = Clientes.Id";
        $consulta2 = mysqli_query($con,$sql2);

        $sql3 = "SELECT Tarjetas.CupoMaximo, Tarjetas.Sobrecupo FROM Tarjetas WHERE Tarjetas.Id = '$idtarjeta'";
        $consulta3 = mysqli_query($con,$sql3);

        if( (mysqli_fetch_array( $consulta2)[0]+$valor) < (mysqli_fetch_array($consulta3)[0]+ mysqli_fetch_array($consulta3)[1])){
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
        }else{
            $_SESSION['respuesta']='La compra sobrepasaría el cupo máximo + sobrecupo';
            header('Location: ../vista/tarjetacredito.php');

        }

        
    }

?>