<?php

if (!isset ($_POST['from']) || strcmp($_POST['from'], "adodm") != 0) {
    exit (-1);
}

require_once '../extras/autoload.php';
require_once '../config/adodm.conf.php';

$conexion = new DB("../config/mysql.inc.php");
$conexion->conectar();

if (isset ($_POST['from'])) {

    $SQL = "DELETE FROM num_telefonico WHERE telefono = '".$_POST['telefono']."'";
    $conexion->consulta($SQL);

    echo mysql_errno();

}

$conexion->desconectar();

?>
