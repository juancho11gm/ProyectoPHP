<?php
  $respuesta='';
  
  session_start();
  if(isset($_SESSION['Usuario'])){
      $Usuario = $_SESSION['Usuario'];
  }
  if(isset($_SESSION['Email'])){
    $Email = ($_SESSION['Email']);
  }
  if(isset($_SESSION['respuesta'])) {
    $respuesta .= '<script> alert("' .$_SESSION['respuesta']. '")</script>';
    echo $respuesta;
    unset($_SESSION['respuesta']);
  }
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Juan Sebastian González">
        <meta name="author" content="Nicolás Suárez">
        <link href="styles.css" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <title>Login</title>
    </head>
    <body class="text-center">
        <?php include('header.php')?>
        <h2>Bienvenido al Sistema Bancario</h2>
        <!--SESIÓN INICIADA-->
        <?php if(isset($_SESSION['Rol'])):?>
            <br>
            <div class="container form-signin">
                <h4>Opciones:</h4>
                <ul class="navbar-nav mr-auto">
                    <?php if(isset($_SESSION['Rol'])):?>
                    <!--MENU CLIENTE-->
                        <?php if($_SESSION['Rol']!='Invitado'):?>
                        <li >
                            <a class="p-2 text-dark"  href="./cuentaahorros.php">Cuenta de ahorros</a>
                        </li>
                        <li >
                            <a class="p-2 text-dark " href="./tarjetacredito.php">Tarjetas de crédito</a>
                        </li >
                        <li>
                            <a class="p-2 text-dark " href="./creditos.php">Créditos</a>
                        </li>
                        <?php if($_SESSION['Rol']=='Usuario'):?>
                        <li>
                            <a class="p-2 text-dark " href="./mensajes.php?id=<?php echo $_SESSION['Id']?>">Mensajes</a>
                        </li>
                        <?php endif?>
                        <!--MENU INVITADO-->
                        <?php else:?>
                        <li >
                            <a class="p-2 text-dark " href="./creditos.php">Créditos</a>
                        </li>
                    <?php endif?>

                    
                    <?php if($_SESSION['Rol']=='Usuario'):?>

                            <li>
                                <a class="p-2 text-dark" href="./mismovimientos.php">Mis movimientos</a>
                            </li>

                    <?php endif?>
                    
                    <!--MENU ADMIN-->
                    <?php if($_SESSION['Rol']=='Administrador'):?>
                        <li>
                            <a class="p-2 text-dark " href="./centroMensajes.php">Mensajes</a>
                        </li>
                        <li>
                            <?php if($_SESSION['Rol']=='Administrador') echo '<a class="p-2 text-dark " href="./administrador.php">Panel Administrador</a>';?>
                        </li>
                    <?php endif?>
                <?php endif?>
                    <li >
                        <a class="btn btn-outline-danger my-2 my-sm-0" href="../controlador/salir.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>


        <?php else:?>
        <br>
        <div class="ingreso">
            <div class=" form-signin">
                <form class="form" method="post" action="../controlador/validaringreso.php">
                    <h1 >Ingresa al sistema</h1>
                    <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Usuario" required>
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Contraseña" required>
                    <br>
                    <button class="btn btn-success btn-block" name="cliente"  type="submit">Login</button>
                    <a href="registro.php" class="btn btn-outline-info btn-block">Regístrate</a>
                </form>
            </div>
            <div class=" form-signin">
                <form class="form" method="post" action="../controlador/validaringreso.php">
                    <h1>Acceder como invitado</h1>
                    <div class="form-group">
                        <input type="number" id="inputPassword" name="cedula" class="form-control" placeholder="Cédula" required>
                        <input type="email" id="inputEmail" name="invitado_email" class="form-control" placeholder="Email" required>
                        <br>
                        <button class="btn btn-success btn-block" name="invitado" type="submit">Acceder como Invitado</button>
                    </div>
                </form>
            </div>
        </div>
        <?php endif?>
    </body>
</html>