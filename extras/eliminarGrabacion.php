<?php

if (!isset ($_POST['from']) || strcmp($_POST['from'], "adodm") != 0) {
    exit (-1);
}

require_once '../extras/autoload.php';
require_once '../config/adodm.conf.php';

$conexion = new DB("../config/mysql.inc.php");
$conexion->conectar();

if (isset ($_POST['from'])) {

    $SQL = "SELECT nombre FROM grabacion WHERE id_grabacion = '".$_POST['grabacion']."'";
    $resultado = $conexion->consulta($SQL);
    $linea = mysql_fetch_object($resultado);

    $SQL = "DELETE FROM grabacion WHERE id_grabacion = '".$_POST['grabacion']."'";
    $conexion->consulta($SQL);

    if (mysql_errno() == 0) {
        if(!unlink($_ADODM['rutaGrabaciones'] . $linea->nombre)){
            echo "-1";
            return;
        }
    }

    echo mysql_errno();

}

$conexion->desconectar();

?>
