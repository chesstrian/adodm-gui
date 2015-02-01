<?php
require_once '../extras/autoload.php';
require_once '../config/adodm.conf.php';

$telefonos = array ();

$SQL = "SELECT * FROM num_telefonico WHERE 1";

$conexion = new DB();
$conexion->conectar();

$consulta = $conexion->consulta($SQL);
while ($row = mysql_fetch_object($consulta)) {
    $temp = new NumeroTelefonico($row->telefono, $row->nombres, $row->apellidos, $row->empresa);
    array_push($telefonos, $temp);
    $temp = null;
}

$conexion->desconectar();

?>
