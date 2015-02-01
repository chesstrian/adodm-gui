<?php
$pid = pcntl_fork();

if ($pid == 0) {
    exec("php-cgi /var/www/html/adodm/AmiDialer.php");
}
?>
