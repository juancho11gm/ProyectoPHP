<nav class="navbar navbar-expand-lg navbar-light bg-light shadow ">
    <a class="navbar-brand" href="index.php" >PROYECTO PHP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <?php if(isset($_SESSION['Rol'])):?>
            <!--MENU CLIENTE-->
            <?php if($_SESSION['Rol']!='Invitado'):?>
            <li class="nav-item">
                <a class="p-2 text-dark" href="./cuentaahorros.php">Cuenta de ahorros</a>
            </li>
            <li class="nav-item">
                <a class="p-2 text-dark" href="./tarjetacredito.php">Tarjetas de crédito</a>
            </li >
            <li>
                <a class="p-2 text-dark" href="./creditos.php">Créditos</a>
            </li>
            <li>
                <a class="p-2 text-dark" href="./mensajes.php">Mensajes</a>
            </li>

            <?php if($_SESSION['Rol']=='Usuario'):?>

            <li>
                <a class="p-2 text-dark" href="./mismovimientos.php">Mis movimientos</a>
            </li>

            <?php endif?>

            <!--MENU INVITADO-->
            <?php else:?>
            <li class="nav-item">
                <a class="p-2 text-dark" href="./creditos.php">Créditos</a>
            </li>
            <?php endif?>
            
            <!--MENU ADMIN-->
            <?php if($_SESSION['Rol']=='Administrador'):?>
            <li>
                <?php if($_SESSION['Rol']=='Administrador') echo '<a class="p-2 text-dark" href="./administrador.php">Administrador</a>';?>
            </li>
            <?php endif?>
        <?php endif?>
        </ul>


        <?php if(isset($_SESSION['Rol'])): ?>
        <form class="form-inline my-2 my-lg-0" action="../controlador/salir.php" method="POST">
            <ul class="navbar-nav mr-auto" >

                <?php if($_SESSION['Rol']=='Invitado'):?>
                <li class="nav-item">
                    <a class="p-2 text-dark"><?php echo $Email;?> </a>
                </li>
                <?php else:?>
                <li>
                    <a class="p-2 text-dark" style="text-transform: capitalize;"><?php echo $Usuario; ?></a>
                </li>
                <?php endif?>
                <li class="nav-item">
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Cerrar Sesión</button>
                </li>

            </ul>
        </form>
        <?php else:?>
        
            <a class="btn btn-outline-success my-2 my-sm-0"  style="margin-right:10px" href="index.php">Iniciar Sesión</a>
            <a class="btn btn-outline-success my-2 my-sm-0" href="registro.php">Registrarme</a>
        
        <?php endif?>
    </div>
</nav>
<br>
<br>
