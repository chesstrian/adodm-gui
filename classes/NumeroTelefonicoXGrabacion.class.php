<?php
/**
 * Description of NumeroTelefonicoXGrabacionclass
 *
 * @author DaPa
 */
 class NumeroTelefonicoXGrabacion {
    public $telefono;           // Se usa el objeto
    public $grabacion;        // Se usa el objeto
    public $fechaRealizacion;
    public $estado;

    function __construct($telefono, $grabacion, $fechaRealizacion, $estado) {
        $this->telefono = $telefono;
        $this->grabacion = $grabacion;
        $this->fechaRealizacion = $fechaRealizacion;
        $this->estado = $estado;
    }

    function getID() {
        return $this->id . " - " . $this->grabacion;
    }

    function getTelefono() {
        return $this->telefono->getTelefono();
    }

    function getIDGrabacion() {
        return $this->grabacion->getID();
    }

    function getNombreGrabacion() {
        return $this->grabacion->getNombre();
    }

    function getFechaRealizacion() {
        return $this->fechaRealizacion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getEstadoTexto($estados) {
        return $estados[$this->estado];
    }
}
?>
