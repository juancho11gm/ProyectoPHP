
<?php 
    session_start();
    $Usuario = $_SESSION['Usuario'];
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    
    $id = $_SESSION['Id'];



    $sql = "SELECT DISTINCT Movimientos.Id, Movimientos.Valor, Movimientos.Origen, Movimientos.Destino, Movimientos.Tipo FROM  Movimientos, cuentasahorros WHERE (Movimientos.Origen = cuentasahorros.Id or Movimientos.Destino = cuentasahorros.Id) and '$id' = CuentasAhorros.ClienteId  ; ";
    $query = mysqli_query($con,$sql);
    $movimientos = mysqli_fetch_all($query);


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
    <title>Mis movimientos</title>
</head>
<body>
<?php include('header.php')?>

    <div class="container form-signin">
        <h4 class="title">Movimientos de la cuenta</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor</th>
                    <th>ID origen</th>
                    <th>ID destino</th>
                    <th>Tipo</th>
                    <th></th>
                </tr>
            </thead>    
            <tbody>
                <?php foreach($movimientos as $c):?>
                <tr>
                    <td><?php echo $c[0];?></td>
                    <td><?php echo $c[1];?> JaveCoins </td>
                    <td><?php echo $c[2];?></td>
                    <td><?php echo $c[3];?></td>
                    <td><?php echo $c[4];?></td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>

</body>
</html>