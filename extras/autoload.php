<?php

// Uso: Incluir autoload.php (este archivo) y ya, no es necesario hacer la
//      llamada explicita de la función.

function __autoload($className) {
    $directories = array(
        'classes/',
        '../classes/'
    );

    $fileNameFormats = array(
        '%s.php',
        '%s.class.php',
    );

    foreach($directories as $directory) {
        foreach($fileNameFormats as $fileNameFormat) {
            $path = $directory.sprintf($fileNameFormat, $className);
            if(file_exists($path)) {
                include_once $path;
                return;
            }
        }
    }

    echo "No se encontró la clase " . $className;
    
}

?>
