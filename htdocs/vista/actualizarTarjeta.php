<?php 
    session_start();
    if(isset($_SESSION['Usuario'])){
        $Usuario = $_SESSION['Usuario'];
    }
   
    if($_GET){
        $id = $_GET['Id'];
        include_once('../config/config.php');
        $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
        $sql = "SELECT * FROM Tarjetas WHERE id = '$id'";
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
    <title>Tarjeta</title>
</head>
<body>
    <?php include('header.php')?>
    <h2 class="title">Edición de tarjetas</h2>
    <div class="container form-signin">
        <form action="../controlador/actualizarTarjeta.php" method="POST">
            <div class="row">
                <label for="">CupoMaximo</label>
                <input type="number" class="form-control" name="cupomaximo" value="<?php echo $datos['CupoMaximo'] ?>">
            </div>
            <div class="row">
                <div class="col">
                    <label for="">Tasa de Interés</label>
                    <input type="number" name="tasa" value="<?php echo $datos['TasaInteres'] ?>" class="form-control" <?php if($_SESSION['Rol']=='Invitado') echo "disabled";?>>
                </div>
                <div class="col">
                    <label for="">Sobrecupo</label>
                    <input type="number" class="form-control" value="<?php echo $datos['Sobrecupo'] ?>" name="sobrecupo">
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <label for="">Cuota de manejo</label>
                    <input type="number" class="form-control" name="cuotamanejo" value="<?php echo $datos['CuotaManejo'] ?>">
                </div>
                <div class="col">
                    <label for="">Aprobado</label>
                    <input type="text" class="form-control" name="aprobado" value="<?php echo $datos['Aprobada']?>">
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $datos['Id']?>">
            <br>
            <div class="row">
                
                <button type="submit" class="btn btn-success col">Enviar</button>
                <a href="../controlador/aprobarTarjeta.php?Id=<?php echo $datos[0]?>" class="btn btn-outline-info col">Aprobar</a>
            </div>
        </form>
    </div>
</body>
</html>