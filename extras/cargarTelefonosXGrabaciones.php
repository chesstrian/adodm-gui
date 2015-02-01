<?php
require_once '../extras/autoload.php';
require_once '../config/adodm.conf.php';

$telefonos_x_grabaciones = array ();

$SQL = "SELECT * FROM num_tel_X_grab WHERE 1";

$conexion = new DB();
$conexion->conectar();

$consulta = $conexion->consulta($SQL);
while ($row = mysql_fetch_object($consulta)) {

    $datos_telefono = mysql_fetch_object( $conexion->consulta("SELECT * FROM num_telefonico WHERE telefono = " . $row->telefono) );
    $datos_grabacion = mysql_fetch_object( $conexion->consulta("SELECT * FROM grabacion WHERE id_grabacion = " . $row->id_grabacion) );

    $temp = new NumeroTelefonicoXGrabacion(new NumeroTelefonico($datos_telefono->telefono, $datos_telefono->nombres, $datos_telefono->apellidos, $datos_telefono->empresa),
        new Grabacion($datos_grabacion->id_grabacion, $datos_grabacion->nombre, $datos_grabacion->fecha_ingreso, $datos_grabacion->duracion),
        $row->fecha_realizacion,
        $row->estado);

    array_push($telefonos_x_grabaciones, $temp);
    $temp = null;
}

$conexion->desconectar();

?>
