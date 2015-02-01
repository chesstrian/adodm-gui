<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NumeroTelefonicoclass
 *
 * @author DaPa
 */
class NumeroTelefonico {
    public $telefono;
    public $nombres;
    public $apellidos;
    public $empresa;
    
    function __construct($telefono, $nombres, $apellidos, $empresa) {
        $this->telefono = $telefono;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->empresa = $empresa;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmpresa() {
        return $this->empresa;
    }
}
?>
