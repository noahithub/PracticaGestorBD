<?php

/*
 * Clase de Base de Datos
 */

class BD {

    /**
     * Atributos de la clase BD
     */
    private $conexion;
    private $host;
    private $user;
    private $pass;
    private $bd;
    private $info;

    /**
     * Constructor de la clase BD al que le pasamos los siguientes parámetros
     * @param type $host
     * @param type $user
     * @param type $pass
     */
    public function __construct($conexion, $bd = "") {
        $this->host = $conexion['host'];
        $this->user = $conexion['user'];
        $this->pass = $conexion['pass'];
        if ($bd != "") {
            $this->bd = $bd;
            $this->conexion = $this->conectar();
        }
//        var_dump($conexion);
//        var_dump($bd);
    }

    /**
     * 
     * @return \PDO
     */
    public function conectar() {
        try {
            $conexion = new PDO("mysql:host=" . $this->host . "; dbname=$this->bd", $this->user, $this->pass);
            return $conexion;
        } catch (Exception $ex) {
            echo "Error conectando a la base de datos " . $ex->getMessage();
        }
    }

    /**
     * 
     * @return type
     */
    public function verBasesDatos() {
        try {
            //echo "$this->host, $this->user, $this->pass";
            $conexion = new PDO("mysql:host=" . $this->host, $this->user, $this->pass);
            $sentencia = $conexion->prepare("show databases");
            $sentencia->execute();
            while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                $filas[] = $fila;
            }
            return $filas;
        } catch (Exception $ex) {
            die("Error conectando a la base de datos " . $ex->getMessage());
        }
    }

    /**
     * 
     * @return type
     */
    public function mostrarTablas() {
        $filas = [];
        $resultado = $this->conexion->prepare("show full tables");
        $resultado->execute();
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $filas[] = $fila;
        }
        return $filas;
    }

    /* Realizar método para visualizar el nombre de los campos de las tablas
     * desde el fichero gestionarTabla
     */
    public function nombreCampos(string $table_name) {
        $campos = [];
        $sentencia = "select * from $table_name";
        $resultado=$this->conexion->prepare($sentencia);
        $resultado->execute();
        $campos_obj=$resultado->fetch(PDO::FETCH_ASSOC);
        foreach ($campos_obj as $campo) {
            $campos[]=$campo->name;
        }
        return $campos;
    }

    /**
     * 
     * @return type
     */
    public function getHost() {
        return $this->host;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function getBd() {
        return $this->bd;
    }

    public function setBd($bd) {
        $this->bd = $bd;
    }

    /**
     * Función con la que se cierra la conexión
     */
    public function cerrarBD() {
        $this->conexion->close();
    }

}
