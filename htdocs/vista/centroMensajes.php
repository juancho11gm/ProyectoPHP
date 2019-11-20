<?php 
    session_start();
    if(isset($_SESSION['Usuario'])){
        include_once('../config/config.php');
        $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
        $Usuario = $_SESSION['Usuario'];

        $sql = "SELECT * FROM Clientes ";
        $query = mysqli_query($con,$sql);
        $chats = mysqli_fetch_all($query);
        
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
    <title>Centro Mensajes</title>
</head>
<body>
    <?php include('header.php')?>
    <h2 class="title">Centro de Mensajes</h2>
    <div class="container form-signin mensajes">
        <?php foreach($chats as $c):?>
            <?php if($c[3] != 'Administrador'):?>
                <?php 
                    
                    $sql = "SELECT COUNT(*) FROM Mensaje WHERE IdChat ='$c[0]'";
                    $query = mysqli_query($con,$sql);
                    $count = mysqli_fetch_all($query);    
                ?>
                <div class="container form-signin" style="width: 50%">
                    <div class="row">
                        <div class="col-sm-8">
                            <h4 style="text-transform: uppercase"><?php echo $c[1]?></h4>
                            <p>Mensajes: <?php echo $count[0][0]?></p>
                        </div>
                        <div class="col-sm-4">
                            <a href="mensajes.php?id=<?php echo $c[0]?>" class="btn btn-success btn-block">Ver</a>
                        </div>
                    </div>
                </div>
            <?php endif?>
        <?php endforeach?>
    </div>
</body>
</html>