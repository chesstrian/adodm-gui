$(document).ready(function(){
    $("#ListaTelefonica").tablesorter();

    var fixHelper = function(e, ui) {
        ui.children().each(function() {
            $(this).width($(this).width());
        });
        return ui;
    };

    $("#listaTelefonica tbody.listaTelefonicaBody").sortable({
        placeholder: 'ui-state-highlight',
        helper: fixHelper
    }).disableSelection();

    $("#llamar").click(function (){

        $("#ListaTelefonica > tbody > tr > td > :checked").each(function() {
            var check = $(this);
            var tr = $("#ListaTelefonica > tbody > tr[id="+$(this).attr("id")+"]");
            var dataString = "from=adodm&telefono=" + tr.attr("telefono") + "&grabacion=" + tr.attr("grabacion");

            $.ajax({
                type: "POST",
                url: "extras/registrarLlamada.php",
                data: dataString,
                async: true,
                success: function(msg) {
                    if(msg == "0") {
                        check.attr("checked", false);
                        tr.children("td").effect("highlight", {}, 2000).css("color", "green");
                    } else {
                        tr.children("td").effect("highlight", {}, 2000).css("color", "red");
                    }
                }
            });
        });

        alert("Realizando llamadas en segundo plano, puede continuar con sus tareas.");

        $.ajax({
            type: "POST",
            url: "extras/comenzarLlamadas.php",
            data: "from=adodm",
            async: true
        });
    });

    $("#seleccionar-todos").click(function() {
        $("#ListaTelefonica > tbody > tr > td > input").each(function() {
            $(this).attr("checked", true);
        });
    });

    $("#deseleccionar-todos").click(function() {
        $("#ListaTelefonica > tbody > tr > td > input").each(function() {
            $(this).attr("checked", false);
        });
    });

    $("#telefono, #grabacion").change(function() {

        $("tbody > tr").hide();

        var telefono = $("#telefono").val();
        var grabacion = $("#grabacion").val();

        var condicion_show = "tbody>tr";

        if (telefono != 0) {
            condicion_show += "[telefono="+telefono+"]";
        }
        if (grabacion != 0) {
            condicion_show += "[grabacion="+grabacion+"]";
        }
        
        $(condicion_show).show();
    });

    $("#eliminar-telefonoXGrabacion").click(function() {
        $("#ListaTelefonica > tbody > tr > td > :checked").each(function() {
            var tr = $("#ListaTelefonica > tbody > tr[id="+$(this).attr("id")+"]");
            var dataString = "from=adodm&telefono=" + tr.attr("telefono") + "&grabacion=" + tr.attr("grabacion");

            $.ajax({
                type: "POST",
                url: "extras/eliminarTelefonoXGrabacion.php",
                data: dataString,
                async: true,
                success: function(msg) {
                    if(msg == "0") {
                        tr.remove();
                    } else {
                        tr.children("td").effect("highlight", {}, 2000).css("color", "red");
                    }
                }
            });
        });
    });
});
