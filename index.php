<?php
/**
 * Se utiliza el spl_autoload_register para incluir lo diferentes 
 * archivos-clases que se utilizan en el programa
 */
spl_autoload_register(function($nombre_clase) {
    require $nombre_clase . '.php';
});

session_start();
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
                // put your code here
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
                <input type="submit" value="Conectar" name="login" class="btnConectar"/>
            </form>
        </fieldset>

    </body>
</html>
