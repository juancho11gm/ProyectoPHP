<?php
    session_start();
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    $sql = "SELECT * FROM CuentasAhorros WHERE ClienteId =".$_SESSION['Id'].";";
    $arreglo = mysqli_query($con,$sql);
    $new_array = array();
    while( $row = mysqli_fetch_array( $arreglo)){
        $new_array[]=$row; // Inside while loop
    }
    $_SESSION['CuentasAhorros'] = $new_array;
    
?>
  