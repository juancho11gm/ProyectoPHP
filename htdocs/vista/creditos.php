<?php 
    session_start();
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
   
    if(isset($_SESSION['Usuario'])){
        $Usuario = $_SESSION['Usuario'];
        if($_SESSION['Rol']=="Usuario"){
            $id = $_SESSION['Id'];
            $sql = "SELECT * FROM Creditos WHERE ClienteId ='$id'";
        }
        if($_SESSION['Rol']=="Administrador"){
            $sql = "SELECT * FROM Creditos";
        }
    }else{
        if(isset($_SESSION['Email'])){
            $Email = $_SESSION['Email'];
            $sql = "SELECT * FROM Creditos WHERE Invitado ='$Email'";    
        }
    }

    $query = mysqli_query($con,$sql);
    $creditos = mysqli_fetch_all($query);

    

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
    <h2 class="title">Créditos</h2>
    <div class="container form-signin">
        <?php if($_SESSION['Rol']!='Administrador'):?>
        <div>
            <a href="crearCredito.php"class="btn btn-outline-success">Pedir Crédito</a>
        </div>
        <?php endif?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Monto</th>
                    <th>Tasa Interes</th>
                    <th>Cuota Manejo</th>
                    <th>Aprobada</th>
                    <?php if($_SESSION['Rol']=='Administrador'):?>
                    <th>ID Cliente</th>
                    <th>ID Invitado</th>
                    <?php endif?>
                    <th>Fecha Pago</th>
                    <th></th>
                </tr>
            </thead>    
            <tbody>
                <?php foreach($creditos as $c):?>
                <tr>
                    <td><?php echo $c[0]?></td>
                    <td><?php echo $c[1]?></td>
                    <td><?php echo $c[2]?></td>
                    <td><?php echo $c[3]?></td>
                    <td><?php echo $c[4]?></td>
                    <?php if($_SESSION['Rol']=='Administrador'):?>
                    <td><?php echo $c[5]?></td>
                    <td><?php echo $c[7]?></td>
                    <?php endif?>
                    <td><?php echo $c[6]?></td>
                    <td>
                    <?php if($_SESSION['Rol']=='Administrador'):?>
                            <?php if($c[4] == 'N'):?>
                            <a href="../controlador/aprobarCredito.php?Id=<?php echo $c[0]?>" class="btn btn-info">Aprobar</a>
                            <?php endif?>
                            <a href="actualizarCredito.php?Id=<?php echo $c[0]?>" class="btn btn-outline-success">Editar</a>
                    <?php endif?>
                        <a href="../controlador/eliminarCredito.php?id=<?php echo $c[0]?>" class="btn btn-outline-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</body>
</html>