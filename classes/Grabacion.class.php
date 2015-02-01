<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grabacionclass
 *
 * @author DaPa
 */
class Grabacion {
    public $id;
    public $nombre;
    public $fechaIngreso;
    public $duracion;

    function __construct($id, $nombre, $fechaIngreso, $duracion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fechaIngreso = $fechaIngreso;
        $this->duracion = $duracion;
    }

    function getID() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getFechaIngreso() {
        return $this->fechaIngreso;
    }

    function getDuracion() {
        return $this->duracion;
    }
}
?>
