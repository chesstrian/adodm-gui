<?php
/**
 * Funciones para el Manejo de Eventos de Asterisk
 *
 */

/**
 * Muestra los detalles del evento
 */
function E_Print($ecode, $data, $server, $port) {
    echo "\n";
    foreach($data as $key=>$val)
        echo "$key = $val\n";
    echo "\n";
}

/**
 *
 */
function E_Newstate($ecode, $data, $server, $port) {
    $cond = strcmp($data['State'], "Up") == 0 && strcmp($data['CallerID'], "1234567") == 0 && strcmp($data['CallerIDName'], "DaCH Adodm") == 0;
    if($cond) {
        $uniqueids = sfYaml::load('extras/uniqueid.yaml');

        if(!is_array($uniqueids['UniquesIds']))
            $uniqueids['UniquesIds'] = array();
        array_push($uniqueids['UniquesIds'], $data['Uniqueid']);

        $yaml = sfYaml::dump($uniqueids);
        file_put_contents('extras/uniqueid.yaml', $yaml);
    }
}
/**
 * Procesa el archivo bandera.yaml al colgarse una llamada
 * Se invoca ante un evento hangup
 */
function E_Hangup($ecode, $data, $server, $port) {
    $uniqueids = sfYaml::load('extras/uniqueid.yaml');
    foreach ($uniqueids['UniquesIds'] as $key => $value) {
        if($data['Uniqueid'] == $value) {
            $array_aux = array_slice($uniqueids['UniquesIds'], 0, $key);
            array_push($array_aux, array_slice($uniqueids['UniquesIds'], $key + 1, count($uniqueids['UniquesIds'])));
            
            $uniqueids['UniquesIds'] = $array_aux;
            
            $yaml = sfYaml::dump($uniqueids);
            file_put_contents('extras/uniqueid.yaml', $yaml);

            $bandera = sfYaml::load('extras/banderas.yaml');
            $bandera['CanalesLibres'] += 1;
            $yaml = sfYaml::dump($bandera);
            file_put_contents('extras/banderas.yaml', $yaml);

            break;
        }
    }


}
?>
