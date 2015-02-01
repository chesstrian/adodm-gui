<?php

$_ADODM['ruta_absoluta'] = "/var/www/html/adodm/";

$_ADODM = sfYaml::load($_ADODM['ruta_absoluta'] .  'config/adodm.yaml');

// CONSTANTES
define("CODIGO_ESTADO_SIN_EFECTUAR", 0);
define("CODIGO_ESTADO_POR_REALIZAR", 1);
define("CODIGO_ESTADO_EXITO", 2);
define("CODIGO_ESTADO_RECHAZO", 3);

global $_ADODM;

?>
