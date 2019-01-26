<?php
/**
 * Se utiliza el spl_autoload_register para incluir lo diferentes 
 * archivos-clases que se utilizan en el programa
 */
spl_autoload_register(function($nombre_clase) {
    require_once $nombre_clase . '.php';
});

session_start();

//Guardo los datos de conexión en variable de sesión
  $_SESSION['host'] = filter_input(INPUT_POST, 'host');
  $_SESSION['user'] = filter_input(INPUT_POST, 'user');
  $_SESSION['pass'] = filter_input(INPUT_POST, 'pass');
  
  
  $basedatos = filter_input(INPUT_POST, 'basedatos');

  //Conectamos a la base de datos
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
        <fieldset id="sup"style="width:25%">
            <legend>Listado bases de datos</legend>
            <form action="index.php" method='POST'>
                <input type="submit" value="Volver" name="volver">
            </form>
        </fieldset>
 
        <fieldset style="width:70%">
            <legend>Gestion de las Bases de Datos <span class="nomInfo"><?php echo $bd->get_database(); ?></span></legend>
                <?php
                echo "<form action='gestionarTabla.php' method='post'>";
                foreach ($tablas as $tabla)
                  echo "<input type=submit value=$tabla[0] name=tabla>";
                $_SESSION['bd'] = $basedatos;
                //Muy importante
                $bd->cerrarDB();
                ?>
        </form>
    </fieldset>
    </body>
</html>