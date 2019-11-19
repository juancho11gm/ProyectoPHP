<?php 
    session_start();
    if(isset($_SESSION['Usuario'])){
        $Usuario = $_SESSION['Usuario'];
    }
    if(isset($_SESSION['Email'])){
        $Email = $_SESSION['Email'];
    }

    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    $sql = "SELECT * FROM datosbasicos";
    $query = mysqli_query($con,$sql);
    $datos = mysqli_fetch_array($query);
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
    <title>Credito</title>
</head>
<body>
    <?php include('header.php')?>
    <h2 class="title">Creación de Crédito</h2>
    <div class="container form-signin">
        <form action="../controlador/agregarCredito.php" method="POST">
            <div>
                <label for="">Monto</label>
                <input type="number" class="form-control" name="monto">
            </div>
            <div class="row">
                <div class="col">
                    <label for="">Tasa de Interes</label>
                    <input type="number" name="tasa" value="<?php echo $datos['TasaInteres']?>" class="form-control" <?php if($_SESSION['Rol']=='Invitado') echo "disabled";?>>
                </div>
                <div class="col">
                    <label for="">Cuotas</label>
                    <input type="number" class="form-control" value="<?php echo $datos['CuotaManejo']?>" name="cuotas">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="">Fecha de Pago</label>
                    <input type="date" class="form-control" name="fechaPago">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col"></div>
                <button type="submit" class="btn btn-success col">Enviar</button>
                <div class="col"></div>
            </div>
        </form>
    </div>
</body>
</html>