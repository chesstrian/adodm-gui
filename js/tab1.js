$(document).ready(function(){
    $("#ListaGrabaciones").tablesorter();
    $("#ListaTelefonos").tablesorter();
    $("#Opciones").accordion({
        autoHeight: false,
        collapsible: true
    });

    var errores_grabaciones = new Array();
    errores_grabaciones[1] = "Tamaño de archivo mayor que upload_max_filesize";
    errores_grabaciones[2] = "Tamaño de archivo mayor que max_file_size";
    errores_grabaciones[3] = "Archivo subido solo parcialmente";
    errores_grabaciones[4] = "Archivo no transferido";
    errores_grabaciones[5] = "Ingrese un Archivo de Sonido";

    var errores_telefonos = new Array();


    var boton_telefonos = $('#upload_telefonos');
    var status_telefonos = $('#status-telefonos');
    var boton_grabaciones = $('#upload_grabaciones');
    var status_grabaciones = $('#status-grabaciones');

    new AjaxUpload(boton_grabaciones, {
        action: 'extras/upload.php',
        name: 'grab',
        data: {
            'up_grab' : "set"
        },
        onSubmit : function(file , ext){
            if (! (ext && /^(gsm|wav|mp3)$/.test(ext))){
                status_grabaciones.text('La extensión ' + ext + ' no es soportada');
                return false;
            } else {
                status_grabaciones.text('Subiendo ' + file);
                this.disable();
            }
        },
        onComplete: function(file, response){
            if (response == "0") {
                status_grabaciones.text('');
                this.enable();
                $('<li></li>').appendTo('#lista_grabaciones').text(file);
            } else {
                status_grabaciones.text('Error al subir el archivo ' + file + ': ' + errores_grabaciones[response]);
                this.enable();
            }
        }
    });
        
    new AjaxUpload(boton_telefonos, {
        action: 'extras/upload.php',
        name: 'tel',
        data: {
            'up_tel' : "set"
        },
        onSubmit : function(file , ext){
            if (! (ext && /^(csv|txt)$/.test(ext))){
                status_telefonos.text('La extensión ' + ext + ' no es soportada');
                return false;
            } else {
                status_telefonos.text('Subiendo ' + file);
                this.disable();
            }
        },
        onComplete: function(file, response){
            if (response == "0") {
                status_telefonos.text('');
                this.enable();
                $('<li></li>').appendTo('#lista_telefonos').text(file);
            } else {
                status_telefonos.text('Error al subir el archivo ' + file);
                this.enable();
            }
        }
    });

    $("#agregar-grabacion").click(function() {
        $("#ListaGrabacionesDelSistema > tbody > tr > td > :checked").each(function() {
            var tr = $("#ListaGrabacionesDelSistema > tbody > tr[id="+$(this).attr("id")+"]");
            var dataString = "from=adodm&grabacion=" + $(this).attr("nombreGrabacion");

            $.ajax({
                type: "POST",
                url: "extras/copiarGrabacion.php",
                data: dataString,
                async: true,
                success: function(msg) {
                    if(msg == "0") {
                        tr.children("td").effect("highlight", {}, 2000).css("color", "green");
                    } else {
                        tr.children("td").effect("highlight", {}, 2000).css("color", "red");
                    }
                }
            });
        });
    });

    $("#eliminar-grabacion").click(function() {
        $("#ListaGrabaciones > tbody > tr > td > :checked").each(function() {
            var tr = $("#ListaGrabaciones > tbody > tr[id="+$(this).attr("id")+"]");
            var dataString = "from=adodm&grabacion=" + $(this).attr("id");

            $.ajax({
                type: "POST",
                url: "extras/eliminarGrabacion.php",
                data: dataString,
                async: true,
                success: function(msg) {
                    if(msg == "0") {
                        tr.remove();
                    } else {
                        tr.children("td").effect("highlight", {}, 3000).css("color", "red");
                    }
                }
            });
        });
    });

    $("#eliminar-telefono").click(function() {
        $("#ListaTelefonos > tbody > tr > td > :checked").each(function() {
            var tr = $("#ListaTelefonos > tbody > tr[id="+$(this).attr("id")+"]");
            var dataString = "from=adodm&telefono=" + $(this).attr("id");

            $.ajax({
                type: "POST",
                url: "extras/eliminarTelefono.php",
                data: dataString,
                async: true,
                success: function(msg) {
                    if(msg == "0") {
                        tr.remove();
                    } else {
                        tr.children("td").effect("highlight", {}, 3000).css("color", "red");
                    }
                }
            });
        });
    });

});