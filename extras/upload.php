<?php

require_once '../extras/autoload.php';
require_once '../config/adodm.conf.php';

$conexion = new DB("../config/mysql.inc.php");
$conexion->conectar();

if (isset ($_POST['up_grab'])) {
//Se procesa la subida de una grabación.

    $dir_destino = $_ADODM['rutaGrabaciones'];

    if (strstr($_FILES['grab']['type'], 'audio') == NULL) {
        $_FILES['grab']['error'] = 5;
    }

    switch ($_FILES['grab']['error']) {
        case 0:
            if ( move_uploaded_file($_FILES['grab']['tmp_name'], $dir_destino.$_FILES['grab']['name']) !== false ) {
                $SQL = "INSERT INTO grabacion(nombre) VALUES('" . $_FILES['grab']['name'] . "')";
                $conexion->consulta($SQL);
            }
            break;
    }

    echo $_FILES['grab']['error'];

} else if (isset ($_POST['up_tel'])) {
        $tabla = "num_telefonico";
        $csvfile = $_FILES['tel']['tmp_name'];
        $truncate = "no";
        $cnx = $conexion->link;

        $upload = new CSVImporter($tabla, $csvfile, $truncate, $cnx);
        $upload->Upload();

        echo "0";
    }

$conexion->desconectar();
?>