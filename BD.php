<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
     * @param type $bd
     */
    public function __construct($host, $user, $pass, $bd) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->bd = $bd;
        $this->conexion = $this->conexion();
    }

    /**
     * 
     * @return \mysqli
     */
    private function conexion(){
        $conexion = new mysqli($this->host, $this->user, $this->pass, $this->bd);
        if ($conexion->connect_errno){
            $this->info = "Error conectando...<b>" . $conexion->connect_error . "</b>";
        }
        return $conexion;
    }
}