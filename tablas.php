<?php
/**
 * Se utiliza el spl_autoload_register para incluir lo diferentes 
 * archivos-clases que se utilizan en el programa
 */
spl_autoload_register(function($nombre_clase) {
    require_once $nombre_clase . '.php';
});

//Iniciamos la sesión
session_start();

//Recogemos el nombre de la bd seleccionada
$basedatos = $_SESSION['basedatos'];
//$_SESSION['basedatos'] = $basedatos;
  
  //$conexion = $_SESSION['conexion'];
  //Conectamos a la base de datos, pasandole la variable de sesion con la conexion
  $bd = new BD($_SESSION['conexion'], $basedatos);
  
  //Llamamos al método conectar de la BD
  $bd->conectar();
  
  //Almacenamos en una variable las filas que nos devuelve el método mostrarTablas()
  $nombreTablas = $bd->mostrarTablas();
  
  //Almacenamos en $tablas, el resultado nos devuelve $nombreTablas después de recorrerlo
  //y ver las tablas que hay en la bd seleccionada
  $tablas = [];
  foreach ($nombreTablas as $ta) {
    $tablas[] = $ta['Tables_in_' . $basedatos];
  }
  
  //Comprobamos si se ha hecho click en una tabla
//Y recogemos la tabla y la almacenamos en una variable de sesión
  if (isset($_POST['nomTabla'])) {
    $_SESSION['nomTabla'] = $_POST['nomTabla'];
    header("Location:gestionarTabla.php");
    exit();
}
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
            <legend>Bases de datos seleccionada</legend>
            <form action="index.php" method='POST'>
                <?php echo "<input type='submit' value='$basedatos' name='basedatos'>";?>
                <br/><br/>
                <input type="submit" value="Volver" name="volver">
            </form>
        </fieldset>
 
        <fieldset>
            <legend>Tablas de la Bases de Datos <span class="nomInfo"><?php echo $bd->getBd(); ?></span></legend>
                <?php
                echo "<form action='tablas.php' method='post'><br/>";
                foreach ($tablas as $tabla) {
                  echo "<input type=submit value=$tabla name=nomTabla>";
                }
                
                //Muy importante
                //$bd->cerrarDB();
                ?>
        </form>
    </fieldset>
    </body>
</html>