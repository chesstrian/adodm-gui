<?php

if (!isset ($_POST['from']) || strcmp($_POST['from'], "adodm") != 0) {
    exit (-1);
}

exec("php-cgi /var/www/html/adodm/extras/forkDialer.php");

?>
