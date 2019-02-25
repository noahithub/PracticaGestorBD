<?php

/**
 * Se utiliza el spl_autoload_register para incluir lo diferentes 
 * archivos-clases que se utilizan en el programa
 */
spl_autoload_register(function($nombre_clase) {
    require_once $nombre_clase . '.php';
});
error_reporting(0);
//Iniciamos la sesión
session_start();

//Recogemos el nombre de la bd seleccionada
$basedatos = $_SESSION['basedatos'];

//Conectamos a la base de datos, pasandole la variable de sesion con la conexion
$bd = new BD($_SESSION['conexion'], $basedatos);

//Recogemos el nombre de la tabla
$nombreTabla = $_SESSION['nomTabla'];

//Realizamos la consulta de la tabla seleccionada
$consulta = "SELECT * FROM $nombreTabla";

//Llamamos al método conectar de la BD
$bd->conectar();

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Gestionar Tabla</title>
        <link href="estilos.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <fieldset class="gTabla">
            <legend>Tabla <?php echo "$nombreTabla de la Base de datos $basedatos";?></legend>
            <table class="gestionTabla">
            <thead>
                <tr>
                    <?php
                    //Array de objetos de los nombres de los campos que obtengo en la consulta anterior
                    $campos = $bd->nombreCampos($nombreTabla);
                    foreach ($campos as $campo) {
                        echo "<th>$campo->name</th>";
                    }
                    //echo "<th>Añadir</th>";
                    echo "<th>Editar</th>";
                    echo "<th>Borrar</th>";
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $consulta->fetch_row()) :
                    echo "<tr>";
                    $t = $campos[0]->table;
                    echo "\n <form action=editar.php method='post' >";
                    $i = 0;
                    echo "<input type='hidden' name='tabla' value='$nombreTabla' />";
                    echo "<input type='hidden' name='basedatos' value='$basedatos' />";
                    foreach ($fila as $valor) {
                        echo "<td>$valor</td>";
                        echo "<input type='hidden' value='$valor' name=campos[" . $campos[$i]->name . "] />";
                        $i++;
                    }
                    ?>
                <!--<td><input type="submit" name="submit" value="Añadir" /></td>-->
                <td><input type="submit" name="submit" value="Editar" /></td>
                <td><input type="submit" name="submit" value="Borrar" /></td>
            </tr>
                </form>
                <?php
            
            endwhile;
        ?>
    </tbody> 
</table>
            <input type="submit" name="submit" value="Añadir" />
            <input type="submit" name="submit" value="Cancelar" />
        </fieldset>
    </body>
</html>