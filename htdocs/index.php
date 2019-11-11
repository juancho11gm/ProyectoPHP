<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="./css/signin.css" rel="stylesheet">

        <title>Login</title>
        <style>
        .ingreso{
            display: flex;
            justify-content:center;
        }
        </style>
    </head>
    <body class="text-center">
        <div class="ingreso">
            <div class="container form-signin">
                <form class="form" method="post" action="./controlador/validaringreso.php">
                    <h1 >Ingresa al sistema</h1>
                    <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Usuario" required>
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Contraseña" required>
                    <br>
                    <button class="btn btn-success" name="cliente"  type="submit">Login</button>
                    <a href="./vista/registro.php" class="btn btn-info">Regístrate</a>
                </form>
            </div>
            <div class="container form-signin">
                <form class="form" method="post" action="./controlador/validaringreso.php">
                    <h1>Acceder Como Invitado</h1>
                    <div class="form-group">
                        <input type="number" id="inputPassword" name="cedula" class="form-control" placeholder="Cédula" required>
                        <input type="email" id="inputEmail" name="invitado_email" class="form-control" placeholder="Email" required>
                        <br>
                        <button class="btn btn-success" name="invitado" type="submit">Acceder como Invitado</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>