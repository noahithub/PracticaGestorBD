<?php
/**
 * Se utiliza el spl_autoload_register para incluir lo diferentes 
 * archivos-clases que se utilizan en el programa
 */
spl_autoload_register(function($nombre_clase) {
    require_once $nombre_clase . '.php';
});

session_start();

$host = filter_input(INPUT_POST, 'host');
$user = filter_input(INPUT_POST, 'usuario');
$pass = filter_input(INPUT_POST, 'password');

//Si paso los parámetros de conexión los leo
if (isset($_POST['conectar'])) {
  //Guardo los datos de conexión en variable de sesión
  $_SESSION['conexion']['host'] = filter_input(INPUT_POST, 'host');
  $_SESSION['conexion']['user'] = filter_input(INPUT_POST, 'usuario');
  $_SESSION['conexion']['pass'] = filter_input(INPUT_POST, 'password');
} else {
  //Si ya he establecido previamente conexión, recojo los datos de sesión
  $_SESSION['host'] = 'localhost';
  $_SESSION['user'] = 'root';
  $_SESSION['pass'] = 'root';
}

  $conexion = $_SESSION['conexion'];
  //Si no contendrán null y la conexión fallará y me informará de ello

//Creo un objeto de BD al que le paso los datos de la conexión
$bd = new BD($conexion);


?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestor Base de Datos</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
    </head>
    <body>
        <h1>Gestor de base de datos</h1>
        <fieldset>
            <legend>Acceso para la BD</legend>
            <div>
                <?php
                
                ?>
            </div>
            <br/>
            <form name="acceso" action="." method="POST" enctype="multipart/form-data">
                <div class="host">
                    <label>Host</label>
                    <input type="text" name="host">
                </div>
                <div class="usuario">
                    <label>Usuario</label>
                    <input type="text" name="usuario">
                </div>
                <div class="password">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                <br/>
                <input type="submit" value="Conectar" name="conectar" class="btnConectar"/>
            </form>
        </fieldset>
        <?php
        if (filter_input(INPUT_POST, 'conectar')):
          //Este método retorna un array indexado con los nombres de las bases de datos
          $basesDatos = $bd->verBasesDatos();
          //var_dump($basesDatos);
          $t = [];
          foreach ($basesDatos as $value) {
              $t[] = $value['Database'];
          }
          ?>
        <br/>
          <fieldset>
              <legend>Gestion de las Bases de Datos del host <span class="nomInfo"><?php echo $bd->getHost(); ?></span></legend>
              <form action="tablas.php" method="post">
                  <?php
                  foreach ($t as $basedato) {
                    echo "<input type=radio value=$basedato name=basedatos>";
                    echo "<label for=basedatos>$basedato</label><br />";
                  }
                  //Muy importante cerrar la conexión de forma explícita
                  //$bd->cerrarDB();
                  ?>
                  <br/>
                  <input type="submit" value="Gestionar" class="btnGestionar">
              </form>
          </fieldset>
        <?php endif ?>
    </body>
</html>
