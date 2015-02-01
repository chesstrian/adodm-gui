<?php
require_once "extras/autoload.php";
require_once "config/adodm.conf.php";
require_once "config/ami.inc.php";

$astManager = new AGI_AsteriskManager();
$astRess = $astManager->connect($astHost, $astUser, $astPass);

if (!$astRess) {
    syslog(LOG_INFO, "Connection to Asterisk Manager failed.");
    die(100);
} else {
    $trunk = "SIP/"; // TODO $trunk debe ser configurable, es uno de los campos más importantes

    $exten = "s"; // TODO FR: $exten debe ser configurable, permitirá enviar a una extensión diferente
    $context = "adodm"; // TODO FR: $adodm debe ser configurable, permitirá enviar a otros contextos o solo cambiar el nombre
    $priority = 1; // TODO FR: $priority debe ser configurable, permitirá ir a lugares más avanzados en el contexto

    $application = NULL; // TODO FR: $application debe ser configurable, permitirá correr aplicaciones personalizadas
    $data = NULL; // TODO FR: $data debe ser configurable, permitirá pasar parámetros a applicaciones definidas en $application

    $timeout = 30000; // TODO $timeout debe ser configurable, este es el valor por defecto

    $callerid = '"DaCH Adodm" ' . "<1234567>"; // TODO $callerid debe ser configurable, para identificar a la empresa

    $dir_grab = $_ADODM['rutaGrabaciones'];

    $account = NULL; // TODO FR: Estudiarlo!
    $async = false; // TODO FR: Implementar soporte para llamadas asyncronas (Casi listo)
    $actionid = NULL; //TODO FR: Consultarlo!

    // Procesando info desde la DB

    $CallSQL = "SELECT id_grabacion,telefono,nombre FROM num_tel_X_grab NATURAL JOIN grabacion WHERE estado = " . CODIGO_ESTADO_POR_REALIZAR;

    $conexion = new DB("config/mysql.inc.php");
    $conexion->conectar();

    $consulta = $conexion->consulta($CallSQL);

    while($row = mysql_fetch_object($consulta)) {
        $bandera = sfYaml::load('extras/banderas.yaml');

        if(!$bandera['EventHandlerActivo']) {
            $pid = pcntl_fork();

            if ($pid == 0) {
                exec("php-cgi AmiEventsHandler.php");
                return;
            }

        }
        while($bandera['CanalesLibres'] < 1) {
            $bandera = sfYaml::load('extras/banderas.yaml');
            sleep(1);
        }


        $bandera['CanalesLibres'] -= 1;
        $yaml = sfYaml::dump($bandera);
        file_put_contents('extras/banderas.yaml', $yaml);

        $number = $row->telefono;
        $channel = $trunk . $number;

        $name_grab = explode('.', $row->nombre);
        $variable= "grab=" . $dir_grab . $name_grab[0] . "\r\n"; // TODO FR: Se debe modificar esta asignación para pasar más de una grabación

        if(!$bandera['EventHandlerActivo']) {
            $pid = pcntl_fork();

            if ($pid == 0) {
                exec("php-cgi AmiEventsHandler.php");
                return;
            }

        }
        $astRessult = $astManager->Originate($channel, $exten, $context, $priority, $application, $data, $timeout, $callerid, $variable, $account, $async, $actionid);

        if(strcmp($astRessult['Response'], "Success") == 0) {
            $UpdSQL = "UPDATE num_tel_X_grab SET fecha_realizacion = NOW(), estado = " . CODIGO_ESTADO_EXITO . " WHERE id_grabacion = " . $row->id_grabacion . " AND telefono = " . $row->telefono;
            $conexion->consulta($UpdSQL);
        }
    }
}

$conexion->desconectar();
$astManager->disconnect();
?>
