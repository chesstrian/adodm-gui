<?php

if (!isset ($_POST['from']) || strcmp($_POST['from'], "adodm") != 0) {
    exit (-1);
}

require_once '../extras/autoload.php';
require_once '../config/adodm.conf.php';

$conexion = new DB("../config/mysql.inc.php");
$conexion->conectar();

if (isset ($_POST['from'])) {

    $SQL = "INSERT INTO num_tel_X_grab(telefono, id_grabacion, estado) VALUES('". $_POST['telefono'] ."', '". $_POST['grabacion'] ."', '".CODIGO_ESTADO_SIN_EFECTUAR."')";
    $conexion->consulta($SQL);

    echo mysql_errno();

}

$conexion->desconectar();

?>
