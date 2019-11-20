<?php 
    session_start();
    $Usuario = $_SESSION['Usuario'];
    include_once('../config/config.php');
    $con = mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
    $sql = "SELECT * FROM Clientes";
    $query = mysqli_query($con,$sql);
    $usuarios = mysqli_fetch_all($query);

    $sql = "SELECT * FROM cuentasahorros";
    $query = mysqli_query($con,$sql);
    $cuentas = mysqli_fetch_all($query);

    $sql = "SELECT * FROM tarjetas";
    $query = mysqli_query($con,$sql);
    $tarjetas = mysqli_fetch_all($query);

    $sql = "SELECT * FROM creditos";
    $query = mysqli_query($con,$sql);
    $creditos = mysqli_fetch_all($query);

    $sql = "SELECT * FROM datosbasicos";
    $query = mysqli_query($con,$sql);
    $datos = mysqli_fetch_array($query);

    if($_POST){
        if(isset($_POST['para'])){
            include_once('../controlador/envioCorreo.php');
            $para = $_POST['para'];
            $tema = $_POST['tema'];
            $contenido = $_POST['contenido'];
            $redireccion = 'administrador.php';
            envioCorreo($para,$tema,$contenido,$redireccion);
        }
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
    <title>Administrador</title>
</head>
<body>
    <?php if(isset($_SESSION['Rol'])):?>
    <?php include('header.php')?>

    <h2 class="title">Panel de Administrador</h2>

    <div class="container form-signin">
        <form action="../controlador/actualizarDatosCredito.php" method="POST">
            <div class="row">
                <div class="col">
                    <label for="">Porcentaje de Interes</label>
                    <input type="number" class="form-control" name="interes" value="<?php echo $datos['TasaInteres']?>" required>
                </div>
                <div class="col">
                    <label for="">Cuotas de Manejo</label>
                    <input type="number" class="form-control" name="cuotas" value="<?php echo $datos['CuotaManejo']?>" required>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $datos['Id']?>">
            <br>
            <div class="row">
                <div class="col"></div>
                <button type="submit" class="btn btn-outline-success col">Actualizar</button>
                <div class="col"></div>
            </div>
        </form>
    </div>

    <div class="container form-signin">
        <h4>Usuarios</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th></th>
                </tr>
            </thead>    
            <tbody>
                <?php foreach($usuarios as $u):?>
                <tr>
                    <td><?php echo $u[0]?></td>
                    <td><?php echo $u[1]?></td>
                    <td><?php echo $u[3]?></td>
                    <td>
                        <a href="./actualizarUsuario.php?Id=<?php echo $u[0]?>" class="btn btn-outline-success">Editar</a>
                        <a href="../controlador/eliminarUsuario.php?id=<?php echo $u[0]?>" class="btn btn-outline-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>

        </table>

    </div>

    <div class="container form-signin">
        <h4>Cuentas</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Saldo</th>
                    <th>ID Usuario</th>
                    <th></th>
                </tr>
            </thead>    
            <tbody>
                <?php foreach($cuentas as $c):?>
                <tr>
                    <td><?php echo $c[0];?></td>
                    <td><?php echo number_format($c[1],0);?></td>
                    <td><?php echo $c[2];?></td>
                    <td>
                        <a href="./actualizarCuentaahorros.php?Id=<?php echo $c[0]?>" class="btn btn-outline-success">Editar</a>
                        <a href="../controlador/eliminarCuenta.php?id=<?php echo $c[0]?>" class="btn btn-outline-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>

        </table>

    </div>

    <div class="container form-signin">
        <h4>Tarjetas</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cupo Máximo</th>
                    <th>Sobrecupo</th>
                    <th>Tasa Interes</th>
                    <th>Cuota Manejo</th>
                    <th>Aprobada</th>
                    <th>ID Cliente</th>
                    <th></th>
                </tr>
            </thead>    
            <tbody>
                <?php foreach($tarjetas as $t):?>
                <tr>
                    <td><?php echo $t[0]?></td>
                    <td><?php echo number_format($t[1],2)?></td>
                    <td><?php echo number_format($t[2],2)?></td>
                    <td><?php echo number_format($t[3],2)?></td>
                    <td><?php echo number_format($t[4],2)?></td>
                    <td><?php echo number_format($t[5],2)?></td>
                    <td><?php echo $t[6]?></td>
                    <td>
                        <?php if($t[6] == 'N'):?>
                        <a href="../controlador/aprobarTarjeta.php?IdTarjeta=<?php echo $t[0]?>" class="btn btn-link">Aprobar</a>
                        <?php endif?>
                        <a href="./actualizarTarjeta.php?Id=<?php echo $t[0]?>" class="btn btn-outline-success">Editar</a>
                        <a href="../controlador/eliminarTarjeta.php?id=<?php echo $t[0]?>" class="btn btn-outline-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>

        </table>

    </div>

    <div class="container form-signin">
        <h4>Créditos</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Monto</th>
                    <th>Tasa Interes</th>
                    <th>Cuota Manejo</th>
                    <th>Aprobada</th>
                    <th>ID Cliente</th>
                    <th>Invitado</th>
                    <th>Fecha Pago</th>
                    <th></th>
                </tr>
            </thead>    
            <tbody>
                <?php foreach($creditos as $c):?>
                <tr>
                    <td><?php echo $c[0]?></td>
                    <td><?php echo number_format($c[1],2)?></td>
                    <td><?php echo number_format($c[2],2)?></td>
                    <td><?php echo number_format($c[3],2)?></td>
                    <td><?php echo $c[4]?></td>
                    <td><?php echo $c[5]?></td>
                    <td><?php echo $c[7]?></td>
                    <td><?php echo $c[6]?></td>
                    <td>
                        <?php if($c[4] == 'N'):?>
                        <a href="../controlador/aprobarCredito.php?Id=<?php echo $c[0]?>" class="btn btn-link">Aprobar</a>
                        <?php endif?>
                        <a href="actualizarCredito.php?Id=<?php echo $c[0]?>" class="btn btn-outline-success">Editar</a>
                        <a href="../controlador/eliminarCredito.php?id=<?php echo $c[0]?>" class="btn btn-outline-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>

    <div class="container form-signin">
        <form action="administrador.php" method="POST">
            <h3>Envío de Correo</h3>
            <br>
            <div class="row">
                <label for="" class="col-sm-2">Para:</label>
                <div class="col">
                    <input type="email" class="form-control" name="para" required>
                </div>
            </div>
            <br>
            <div class="row">
                <label for="" class="col-sm-2">Tema:</label>
                <div class="col">
                    <input type="text" class="form-control" name="tema" required>
                </div>
            </div>
            <div>
                <label for="">Contenido</label>
                <textarea name="contenido" id="" class="form-control" cols="30" rows="10" required></textarea>
            </div>
            <br>
            <button class="btn btn-success btn-block">Enviar</button>
        </form>
    </div>
    <br>
    <?php else:?>
        <?php header('location:index.php');?>
    <?php endif?>
</body>
</html>