$(document).ready(function() {

    var iterator_grabaciones = get_iterator_grabacion();
    var iterator_telefonos = get_iterator_telefonos();

    $("#espacio_droppable_t4").droppable({
        accept: ".grabacion_draggable",
        greedy: true,
        drop: function(event, ui) {
            var droppedItem = ui.draggable.clone();
            var nameDroppedItem = ui.draggable.clone().html();
            var idGrabacion = droppedItem[0].attributes["id"].nodeValue;

            if( $("tr[idGrabacion="+idGrabacion+"]").length != 0 ) {
                $("tr[idGrabacion="+idGrabacion+"]").effect("highlight", {}, 3000);
                return false;
            }

            $(this).append("<tr id='G" + iterator_grabaciones + "' idGrabacion='"+idGrabacion+"'></tr>");

            var row = $("tr[id='G" + iterator_grabaciones + "']");

            row.append("<td class='grabacion'>" + nameDroppedItem + "</td>");
            row.append("<td class='telefono_droppable'></td>");
            iterator_telefonos[iterator_grabaciones] = 1;
            iterator_grabaciones++;

            $(".telefono_droppable").droppable({
                accept: ".telefono_draggable",
                greedy: true,
                drop: function(event, ui) {
                    var droppedItem = ui.draggable.clone();
                    var idTelefono = droppedItem[0].attributes["id"].nodeValue;
                    var nameDroppedItem = ui.draggable.clone().html();
                    var parentID = $(this).parent("tr").attr("id").substr(1);

                    if( $("div[id^=G"+parentID+"][idTelefono="+idTelefono+"]").length != 0 ) {
                        $("div[id^=G"+parentID+"][idTelefono="+idTelefono+"]").effect("highlight", {}, 2000);
                        return false;
                    }

                    $(this).append("<div id='G"+parentID+"T"+iterator_telefonos[parentID]+"' idTelefono='"+idTelefono+"'><span>" + nameDroppedItem + "</span></div>");

                    iterator_telefonos[parentID]++;
                }
            });
        }
    });

    $("#guardar_tab4").click(function (){ // TODO - [Rendimiento] - Descartar los ya grabados en una misma consulta.
        var dataString;

        $("tr[id^=G]").each(function() {
            var id = $(this).attr("id");
            var grabacion = $(this).attr("idGrabacion");

            $("div[id^="+id+"T]").each(function() {
                var div = $(this);
                var telefono = $(this).attr("idTelefono");

                dataString = "from=adodm&grabacion=" + grabacion + "&telefono=" + telefono;

                $.ajax({
                    type: "POST",
                    url: "extras/grabarTelefonoXGrabacion.php",
                    data: dataString,
                    async: true,
                    success: function(msg) {
                        if(msg == "0") {
                            div.css("color", "green");
                        } else {
                            div.css("color", "red");
                        }
                    }
                });

            });
        });
    });

    $(".telefono_draggable").draggable({
        helper: 'clone',
        opacity: '0.7'
    });
    $(".grabacion_draggable").draggable({
        helper: 'clone',
        opacity: '0.7'
    });
    $("ul, li").disableSelection();

    $("#listaTelefonos_div").slideUp(0);
    $("#listaGrabaciones_div").slideUp(0);

    $("#listaTelefonos").click(function() {
        $("#listaTelefonos_div").slideToggle("slow");
    });
    $("#listaGrabaciones").click(function() {
        $("#listaGrabaciones_div").slideToggle("slow");
    });
});

function get_iterator_grabacion() {
    var iterator = 1;
    $("#espacio_droppable tr[id!='null']").each(function(i) {
        if (i > 0)
            iterator++;
    });
    return iterator;
}

function get_iterator_telefonos() {
    var iterator = new Array();

    $("#espacio_droppable tr").each(function(i){
        $(this).find("div[id!='null']").each(function(j) {
            iterator[i+1] = j+2;
        });
    });

    return iterator;
}