<?php

if (!isset ($_POST['from']) || strcmp($_POST['from'], "adodm") != 0) {
    exit (-1);
}

require_once '../extras/autoload.php';
require_once '../config/adodm.conf.php';

$conexion = new DB("../config/mysql.inc.php");
$conexion->conectar();

if (isset ($_POST['from'])) {
    $SQL = "UPDATE num_tel_X_grab SET estado = ".CODIGO_ESTADO_POR_REALIZAR." WHERE telefono = ".$_POST['telefono']." AND id_grabacion = ".$_POST['grabacion'];
    $conexion->consulta($SQL);

    echo mysql_errno();
}

$conexion->desconectar();

?>
