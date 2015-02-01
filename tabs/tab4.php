<?php
require_once '../extras/cargarTelefonos.php';
require_once '../extras/cargarGrabaciones.php';
?>

<script type="text/javascript" src="js/tab4.js"></script>

<div id="contenedor_de_asignacion">

    <div id="columna_izquierda">
        <h3><a id="listaGrabaciones" href="#">Grabaciones</a></h3>
        <div id="listaGrabaciones_div">
            <?php foreach ($grabaciones as $i => $grabacion): ?>
            <div id="<?php echo $grabacion->getID(); ?>" class="grabacion_draggable"><?php echo $grabacion->getNombre(); ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="columna_derecha">
        <h3><a id="listaTelefonos" href="#">Tel&eacute;fonos</a></h3>
        <div id="listaTelefonos_div">
            <?php foreach ($telefonos as $i => $telefono): ?>
            <div id="<?php echo $telefono->getTelefono(); ?>" class="telefono_draggable"><?php echo $telefono->getTelefono(); ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="columna_central">
        <h1 align="center">Asignar Tel&eacute;fonos a Grabaciones</h1>

        <table id="espacio_droppable_t4" border="0">
            <tr>
                <th width="20%">GRABACI&Oacute;N</th>
                <th width="80%">TEL&Eacute;FONO</th>
            </tr>
        </table>

        <div>
            <a id="borrar_telefono" href="#">Borrar Telefono</a>
            <input id="telefono" type="text" size="4" style="">
            <span>|</span>
            <a id="borrar_grabacion" href="#">Borrar Grabación</a>
            <input id="id_grabacion" type="text" size="4" style="">
            <span>del Telefono</span>
            <input id="telefono_grabacion" type="text" size="4" style="">
            <span>|</span>
            <a id="guardar_tab4" href="#">GUARDAR</a>
        </div>
    </div>

</div>
