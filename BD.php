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
    public function __construct($host, $user, $pass) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
    }

    /**
     * 
     * @return \mysqli
     */
//    private function conexion(){
//        $conexion = new mysqli($this->host, $this->user, $this->pass, $this->bd);
//        if ($conexion->connect_errno){
//            $this->info = "Error conectando...<b>" . $conexion->connect_error . "</b>";
//        }
//        return $conexion;
//    }
    
    public function verBasesDatos(){
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

    public function getHost() {
        return $this->host;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    /**
     * Función con la que se cierra la conexión
     */
//    public function cerrarBD() {
//        $this->conexion->close();
//    }
}