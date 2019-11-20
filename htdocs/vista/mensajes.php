<?php 
    session_start();
    if(isset($_SESSION['Usuario'])){
        $id = $_GET['id'];
        include_once('../config/config.php');
        $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
        $Usuario = $_SESSION['Usuario'];

        $sql = "SELECT * FROM Mensaje WHERE IdChat = '$id'";
        $query = mysqli_query($con,$sql);
        $mensajes = mysqli_fetch_all($query);
        
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title>Mensajes</title>
</head>
<body>
    <?php include('header.php');?>
    
    <?php if($_SESSION['Rol']=='Administrador'):?>
    <div class="container">
        <a href="centroMensajes.php">
            <i class="material-icons" style="color:black">arrow_back</i>
        </a>
    </div>
    <?php endif?>
    <h2 class="title">Mensajes</h2>
    <div class="container form-signin">
        <div class="mensajes">
            
            <?php foreach($mensajes as $m):?>
                <?php if($m[5] == $_SESSION['Rol']):?>
                <div class="enviado">
                <?php else:?>
                <div class="recibido">
                <?php endif?>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $m[2]?></h5>
                            <p><?php echo $m[3]?></p>
                        </div>
                        <div class="col">
                            <p><?php echo $m[4]?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach?>
            
            <div id="princ"></div>
        </div>
        <br>
        <div>
            <form action="../controlador/agregarMensaje.php" method="POST">
                <div class="row">
                    <div class="col-sm-10">
                        <input type="text" class="form-control " name="mensaje" placeholder="Escribe algo..." required>
                        <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-success">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>