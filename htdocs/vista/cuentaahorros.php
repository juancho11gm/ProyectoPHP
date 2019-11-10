  <?php
  include_once '../controlador/cuentaahorros.php';
  $Usuario = ($_SESSION['Usuario']);
  $_SESSION['CuentasAhorros'];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Cuenta de ahorros</title>
  </head>
  <body>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-2 text-dark" href="./perfil.php"><?php echo $Usuario; ?></a>
          <a class="p-2 text-dark" href="./cuentaahorros.php">Cuenta de ahorros</a>
          <a class="p-2 text-dark" href="./creditos.php">Créditos</a>
          <a class="p-2 text-dark" href="./tarjetacredito.php">Tarjetas de crédito</a>
          <a class="p-2 text-dark" href="./mensajes.php">Mensajes</a>
          <?php if($_SESSION['Rol']=='Administrador') echo '<a class="p-2 text-dark" href="./administrador.php">Administrador</a>';?>
      </nav>
      <a class="btn btn-outline-danger" href="../controlador/salir.php">Salir</a>
    </div>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Saldo</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if(sizeof( $_SESSION['CuentasAhorros'])>0){
                foreach ( $_SESSION['CuentasAhorros'] as $key) {
                    echo '<tr>';
                      echo '<th >'.$key['Id']."</th>";
                      echo "<td> $ ".$key['Saldo']." javecoins </td>";
                    echo '</tr>';
                  }
            }
            
          ?>
        </tbody>
      </table>
        <div class="row">

            <a class="option-btn btn btn-warning" href="./.php">Retiros</a>


            <a class="option-btn btn btn-primary" href="./consign.php">Consignar</a>

        <a class="option-btn btn btn-success" href="./createSavingsAccount.php">Crear Cuenta Ahorros</a>
      </div>
    </div>

  </body>
</html>