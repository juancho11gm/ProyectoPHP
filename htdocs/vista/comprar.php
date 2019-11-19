<?php 
    session_start();
    $Usuario = $_SESSION['Usuario'];
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    
    $id = $_SESSION['Id'];
    $sql = "SELECT * FROM Tarjetas WHERE ClienteId ='$id' AND Aprobada ='S' ";
    $query = mysqli_query($con,$sql);
    $tarjetas = mysqli_fetch_all($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <meta name="author" content="Juan Sebastian González">
    <meta name="author" content="Nicolás Suárez">
    <link href="styles.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Comprar</title>
</head>
<body>
<?php include('header.php')?>
<h1 class="title">Compra con tarjeta de crédito</h1>
    <div class="consignar ">
        <div class="row form-signin">
                <form class="container " action="../controlador/comprar.php" method="post">
                    <label >Id de la Tarjeta de crédito</label>
                    <select name="tarjetaid" class="form-control" id="origin" required>
                    <?php
                        foreach ( $tarjetas as $t ) {
                            echo '<option>'.$t[0].'</option>';
                        }
                    ?>
                    </select>
                <label for="">Valor de la compra</label>
                <input type="number" min="0" class="form-control" name="valor" value="0"?>
                <label for="">Número de cuotas</label>
                <input type="number"  min="1" max="6" class="form-control" value="1" name="cuotas">
                <br>
                <button class="btn btn-lg btn-success btn-block" type="submit">Comprar</button>


                </form>

        </div>
    </div>

</body>