<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
require_once 'extras/autoload.php';
require_once 'config/adodm.conf.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Auto Dial Out Deliver Message</title>
        <link type="text/css" href="css/adodm.css" rel="stylesheet" />
        <link type="text/css" href="css/tablesorter/style.css" rel="stylesheet" />
        <link type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
        <script type="text/javascript" src="js/ajaxupload.js"></script>
        <script type="text/javascript">
            $(function() {
                $("#tabs").tabs();
            });
        </script>
    </head>
    
    <body>

        <div class="header">
            <h1>HEADER</h1>
        </div>

        <div class="content">
            <div id="tabs">
                <ul>
                    <li><a class="tab" href="tabs/tab1.php">Subir Grabaciones y Telefonos</a></li>
                    <li><a class="tab" href="tabs/tab2.php">Grabaciones asignadas a Telefonos</a></li>
                    <li><a class="tab" href="tabs/tab3.php">Asignar Grabaciones a Telefonos</a></li>
                    <li><a class="tab" href="tabs/tab4.php">Asignar Telefonos a Grabaciones</a></li>
                </ul>
            </div>
        </div>

        <div class="footer">
            <h1>FOOTER</h1>
        </div>

    </body>
</html>
