<?php
require_once "extras/autoload.php";
require_once 'extras/AmiEventsFunctions.php';
require_once "config/ami.inc.php";

$bandEvent = sfYaml::load('extras/banderas.yaml');
if($bandEvent['EventHandlerActivo']) {
    return;
}

$bandEvent['EventHandlerActivo'] = true;
$yaml = sfYaml::dump($bandEvent);
file_put_contents('extras/banderas.yaml', $yaml);

$astManager = new AGI_AsteriskManager();
$astRess = $astManager->connect($astHost, $astUser, $astPass);
$evtRess = $astManager->send_request("Events", array ('EventMask'=>'call'));

$astManager->add_event_handler("newstate", "E_Newstate");
$astManager->add_event_handler("hangup", "E_Hangup");
$astManager->wait_response(true);

$bandEvent['CanalesLibres'] = 1; //Implementar configuracion de este parámetro globalmente
$bandEvent['EventHandlerActivo'] = false;
$yaml = sfYaml::dump($bandEvent);
file_put_contents('extras/banderas.yaml', $yaml);

$astManager->disconnect();
?>
