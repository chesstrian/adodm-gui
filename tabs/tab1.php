<?php
require_once '../extras/cargarTelefonos.php';
require_once '../extras/cargarGrabaciones.php';
require_once '../extras/cargarGrabacionesDelSistema.php';
?>

<script type="text/javascript" src="js/tab1.js"></script>

<div id="Opciones">
    <h3><a href="#">Subir Grabaci&oacute;n y/o Tel&eacute;fonos</a></h3>
    <div>
        <div id="upload_grabaciones" class="upload_div">
            <p class="boton_envio">
                <span style="float:left; margin-right:5px; margin-left:5px"><img alt="grabacion" src="images/speaker.png"></span>
                <span style="margin-right:5px; margin-left:5px">Click para subir grabación</span>
            </p>
        </div>
        <div class="ui-state-highlight ui-corner-all" style="display:inline-block">
            <span id="status-grabaciones"></span>
        </div>
        <div>Archivos Subidos:</div>
        <ul id="lista_grabaciones">
        </ul>

        <div id="upload_telefonos" class="upload_div">
            <p class="boton_envio">
                <span style="float:left; margin-right:5px; margin-left:5px"><img alt="grabacion" src="images/phone.png"></span>
                <span style="margin-right:5px; margin-left:5px">Click para subir tel&eacute;fonos</span>
            </p>
        </div>
        <div class="ui-state-highlight ui-corner-all" style="display:inline-block">
            <span id="status-telefonos"></span>
        </div>
        <div>Archivos Subidos:</div>
        <ul id="lista_telefonos">
        </ul>
        <br>
    </div>
    <h3><a href="#">Agregar Grabaciones del sistema</a></h3>
    <div>
        <table id="ListaGrabacionesDelSistema" class="tablesorter">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Nombre</th>
                    <th>Duraci&oacute;n</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grabacionesDelSistema as $i => $grabacionDelSistema): ?>
                <tr id="<?php echo $i; ?>">
                    <td style="width:10px;"><input id="<?php echo $i; ?>" type="checkbox" nombreGrabacion="<?php echo $grabacionDelSistema->getNombre(); ?>"></td>
                    <td><span><?php echo $grabacionDelSistema->getNombre(); ?></span></td>
                    <td><span><?php echo $grabacionDelSistema->getDuracion(); ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="enlaces-acciones">
            <a id="agregar-grabacion" href="#" class="mini">Agregar seleccionadas</a>
        </div>
    </div>
    <h3><a href="#">Listar Grabaciones</a></h3>
    <div>
        <table id="ListaGrabaciones" class="tablesorter">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Nombre</th>
                    <th>Fecha de Ingreso</th>
                    <th>Duraci&oacute;n</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grabaciones as $i => $grabacion): ?>
                <tr id="<?php echo $grabacion->getID(); ?>">
                    <td style="width:10px;"><input id="<?php echo $grabacion->getID(); ?>" type="checkbox"></td>
                    <td><span><?php echo $grabacion->getNombre(); ?></span></td>
                    <td><span><?php echo $grabacion->getFechaIngreso(); ?></span></td>
                    <td><span><?php echo $grabacion->getDuracion(); ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="enlaces-acciones">
            <a id="eliminar-grabacion" href="#" class="mini">Eliminar seleccionados</a>
        </div>
    </div>
    <h3><a href="#">Listar Tel&eacute;fonos</a></h3>
    <div>

        <table id="ListaTelefonos" class="tablesorter">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Tel&eacute;fono</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Empresa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($telefonos as $i => $telefono): ?>
                <tr id="<?php echo $telefono->getTelefono(); ?>">
                    <td style="width:10px;"><input id="<?php echo $telefono->getTelefono(); ?>" type="checkbox"></td>
                    <td><span><?php echo $telefono->getTelefono(); ?></span></td>
                    <td><span><?php echo $telefono->getNombres(); ?></span></td>
                    <td><span><?php echo $telefono->getApellidos(); ?></span></td>
                    <td><span><?php echo $telefono->getEmpresa(); ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="enlaces-acciones">
            <a id="eliminar-telefono" href="#" class="mini">Eliminar seleccionados</a>
        </div>
    </div>
</div>
