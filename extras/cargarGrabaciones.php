<?php
require_once '../extras/autoload.php';
require_once '../config/adodm.conf.php';

$grabaciones = array ();

$SQL = "SELECT * FROM grabacion WHERE 1 ORDER BY nombre";

$conexion = new DB();
$conexion->conectar();

$consulta = $conexion->consulta($SQL);
while ($row = mysql_fetch_object($consulta)) {
    $temp = new Grabacion($row->id_grabacion, $row->nombre, $row->fecha_ingreso, $row->duracion);
    array_push($grabaciones, $temp);
    $temp = null;
}

$conexion->desconectar();

?>
