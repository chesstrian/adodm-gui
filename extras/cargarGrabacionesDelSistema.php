<?php
require_once '../extras/autoload.php';
require_once '../config/adodm.conf.php';

$grabacionesDelSistema = array ();

$dir = $_ADODM['rutaGrabacionesDelSistema'];
$directorio = opendir($dir);
while (($archivo = readdir($directorio)) !== false) {
// TODO - [Rendimiento] - Filtrar archivos de audio
    if ( $archivo != '.' && $archivo != ".." && !is_dir($dir."/".$archivo) ) {
        $temp = new Grabacion(0, $archivo, 0, 0);
        array_push($grabacionesDelSistema, $temp);
        $temp = null;
    }
}
closedir($directorio);
?>
