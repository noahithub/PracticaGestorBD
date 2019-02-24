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

$muestra = false;

//Si hacemos click en un botón
if (isset($_POST['submit'])) {
//Si hacemos click en el botón de Conectar
    if (isset($_POST['Conectar'])) {
        //Guardo los datos de conexión en variable de sesión
        $_SESSION['conexion']['host'] = filter_input(INPUT_POST, 'host');
        $_SESSION['conexion']['user'] = filter_input(INPUT_POST, 'usuario');
        $_SESSION['conexion']['pass'] = filter_input(INPUT_POST, 'password');
    }
    //Si hay conexión, la guardamos en una variable
    if (isset($_SESSION['conexion'])) {
        $conexion = $_SESSION['conexion'];
    } else {
        //Si ya he establecido previamente conexión, recojo los datos de sesión
        $_SESSION['conexion']['host'] = 'localhost';
        $_SESSION['conexion']['user'] = 'root';
        $_SESSION['conexion']['pass'] = 'root';
    }
    //Volvemos a recuperar la conexión
    $conexion = $_SESSION['conexion'];

    //Creo un objeto de BD al que le paso los datos de la conexión
    $bd = new BD($conexion);
    
    //Almacenamos en $basedatos lo que nos devuelve el método verBaseDatos
    $basedatos = $bd->verBasesDatos();

    //Comprobamos si la base de datos es distinta de null, lo recorremos
    if ($basedatos != null) {
        $t = [];
        foreach ($basedatos as $value) {
            $t[] = $value['Database'];
        }
        $muestra = true;
    }
  
}

//Comprobamos si se ha hecho click en una base de datos
//Y recogemos la basededatos y la almacenamos en una variable de sesión
if (isset($_POST['basedatos'])) {
    $_SESSION['basedatos'] = $_POST['basedatos'];
    header("Location:tablas.php");
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
            <legend>Acceso para la BD</legend>
            <div>

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
                <input type="submit" value="Conectar" name="submit" class="btnConectar"/>
            </form>
        </fieldset>
            <br/>
            
            <?php
            if($muestra){
                echo "<fieldset>";
                echo "<legend>Bases de Datos del host <span class='nomInfo'>" . $bd->getHost() . "</span></legend>";
                echo "<form action='index.php' method='post'>";
            foreach ($t as $basedato) {
                echo "<input type='submit' value='$basedato' name='basedatos'><br/>";
                //echo "<label for='basedatos'>$basedato</label><br />";
            }
            //Muy importante cerrar la conexión de forma explícita
            //$bd->cerrarDB();
            
                    //<br/>
                    //<input type="submit" value="Gestionar" name="gestionar" class="btnGestionar">
               echo "</form>";
            }
            ?>
            </fieldset>
    </body>
</html>
