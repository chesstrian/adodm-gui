<?php

if (!isset ($_POST['from']) || strcmp($_POST['from'], "adodm") != 0) {
    exit (-1);
}

require_once '../extras/autoload.php';
require_once '../config/adodm.conf.php';

$conexion = new DB("../config/mysql.inc.php");
$conexion->conectar();

if (isset ($_POST['from'])) {
    if (copy($_ADODM['rutaGrabacionesDelSistema'].$_POST['grabacion'], $_ADODM['rutaGrabaciones'].$_POST['grabacion'])) {
        $SQL = "INSERT INTO grabacion (nombre) VALUES ('" . $_POST['grabacion'] . "')";
        $conexion->consulta($SQL);
    }
    echo mysql_errno();
}

$conexion->desconectar();

?>
