<?php
require_once '../extras/cargarTelefonosXGrabaciones.php';
require_once '../extras/cargarTelefonos.php';
require_once '../extras/cargarGrabaciones.php';
?>

<script type="text/javascript" src="js/tab2.js"></script>

<div style="text-align:left;">

    <label for="telefono" id="telefono_label" class="label">Tel&eacute;fono</label>
    <select name="telefono" id="telefono" class="">
        <option value="0">---</option>
        <?php foreach ($telefonos as $telefono): ?>
        <option value="<?php echo $telefono->getTelefono(); ?>"><?php echo $telefono->getTelefono(); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="grabacion" id="grabacion_label" class="label">Grabaci&oacute;n</label>
    <select name="grabacion" id="grabacion" class="">
        <option value="0">---</option>
        <?php foreach ($grabaciones as $grabacion): ?>
        <option value="<?php echo $grabacion->getID(); ?>"><?php echo $grabacion->getNombre(); ?></option>
        <?php endforeach; ?>
    </select>

</div>

<table id="ListaTelefonica" class="tablesorter">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Telefono</th>
            <th>Grabacion</th>
            <th>Fecha de última llamada</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody class="listaTelefonicaBody">
        <?php foreach ($telefonos_x_grabaciones as $i => $telefono_x_grabacion): ?>
        <tr id="<?php echo "T".$telefono_x_grabacion->getTelefono()."G".$telefono_x_grabacion->getIDGrabacion() ?>" telefono="<?php echo $telefono_x_grabacion->getTelefono(); ?>" grabacion="<?php echo $telefono_x_grabacion->getIDGrabacion(); ?>">
            <td style="width:10px;"><input id="<?php echo "T".$telefono_x_grabacion->getTelefono()."G".$telefono_x_grabacion->getIDGrabacion() ?>" type="checkbox"></td>
            <td><span><?php echo $telefono_x_grabacion->getTelefono(); ?></span></td>
            <td><span><?php echo $telefono_x_grabacion->getNombreGrabacion(); ?></span></td>
            <td><span><?php echo $telefono_x_grabacion->getFechaRealizacion(); ?></span></td>
            <td><span><?php echo $telefono_x_grabacion->getEstadoTexto($_ADODM['estados']); ?></span></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="enlaces-acciones">
    <a id="seleccionar-todos" href="#" class="mini">Seleccionar todos</a>
    <span> | </span>
    <a id="deseleccionar-todos" href="#" class="mini">Deseleccionar todos</a>
    <span> | </span>
    <a id="eliminar-telefonoXGrabacion" href="#" class="mini">Eliminar seleccionados</a>
    <span> | </span>
    <a id="llamar" href="#" class="mini">Llamar</a>
</div>

<?php


?>
