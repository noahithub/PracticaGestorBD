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

//Conectamos a la base de datos, pasandole la variable de sesion con la conexion
$bd = new BD($_SESSION['conexion'], $basedatos);

//Recogemos el nombre de la tabla
$nombreTabla = $_SESSION['nomTabla'];

//Realizamos la consulta de la tabla seleccionada
$consulta = "SELECT * FROM $nombreTabla";

//Llamamos al método conectar de la BD
$bd->conectar();

//Si hacemos click en un botón, comprobamos a cual le ha dado con el switch
if(isset(filter_input(INPUT_POST, 'submit'))){
    switch (filter_input(INPUT_POST, 'submit')) {
        case 'Editar':
            
            break;
        case 'Borrar':
            
            break;
        case 'Añadir':
            
            break;
        case 'Cancelar':
            
            break;
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Editar</title>
    </head>
    <body>
        <fieldset>
            <legend>Editar</legend>
            <form action="editar.php" method="POST">
                <label>Campo 1</label>
                <input type="text" name="" value="" />
                <label>Campo 2</label>
                <input type="text" name="" value=""/>
                <label>Campo 3</label>
                <textarea type="textarea" name="descripcion" rows="10" cols="60" value="">
                    
                </textarea>
                <label>Campo 4</label>
                <input type="text" name="" value=""/>
                <br/><br/>
                <input type="submit" name="submit" value="Añadir"/>
                <input type="submit" name="submit" value="Cancelar"/>
            </form>
        </fieldset>
    </body>
</html>
