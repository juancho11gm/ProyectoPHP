<?php 
    session_start();
    if(isset($_SESSION['Usuario'])){
        $Usuario = $_SESSION['Usuario'];
    }
   
    if($_GET){
        $id = $_GET['Id'];
        include_once('../config/config.php');
        $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
        $sql = "SELECT * FROM Cuentasahorros WHERE id = '$id'";
        $query = mysqli_query($con,$sql);
        $datos = mysqli_fetch_array($query);
    }
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
    <title>Cuenta ahorros</title>
</head>
<body>
    <?php include('header.php')?>
    <h2 class="title">Edición de cuentas</h2>
    <div class="container form-signin">
        <form action="../controlador/actualizarCuentaahorros.php" method="POST">
            <div class="row">
                <label for="">Saldo</label>
                <input type="number" class="form-control" name="saldo" value="<?php echo $datos['Saldo'] ?>">
            </div>
            <div class="row">
                <div class="col">
                    <label for="">Id tarjeta</label>
                    <input type="number" name="id" value="<?php echo $datos['Id'] ?>" class="form-control" readonly>
                </div>
                <div class="col">
                    <label for="">Id cliente</label>
                    <input type="number" class="form-control" value="<?php echo $datos['ClienteId'] ?>" name="clienteid" readonly>
                </div>

            </div>
            
            <input type="hidden" name="id" value="<?php echo $datos['Id']?>">
            <br>
            <div class="row">
                
                <button type="submit" class="btn btn-success col">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>