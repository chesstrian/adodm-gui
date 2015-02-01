$(document).ready(function() {

    var iterator_telefonos = get_iterator_telefono();
    var iterator_grabaciones = get_iterator_grabaciones();

    $("#espacio_droppable_t3").droppable({
        accept: ".telefono_draggable",
        greedy: true,
        drop: function(event, ui) {
            var droppedItem = ui.draggable.clone();
            var nameDroppedItem = ui.draggable.clone().html();
            var idTelefono = droppedItem[0].attributes["id"].nodeValue;

            if( $("tr[idTelefono="+idTelefono+"]").length != 0 ) {
                $("tr[idTelefono="+idTelefono+"]").effect("highlight", {}, 3000);
                return false;
            }

            $(this).append("<tr id='T" + iterator_telefonos + "' idTelefono='"+idTelefono+"'></tr>");

            var row = $("tr[id='T" + iterator_telefonos + "']");

            row.append("<td class='telefono'>" + nameDroppedItem + "</td>");
            row.append("<td class='grabacion_droppable'></td>");
            iterator_grabaciones[iterator_telefonos] = 1;
            iterator_telefonos++;

            $(".grabacion_droppable").droppable({
                accept: ".grabacion_draggable",
                greedy: true,
                drop: function(event, ui) {
                    var droppedItem = ui.draggable.clone();
                    var idGrabacion = droppedItem[0].attributes["id"].nodeValue;
                    var nameDroppedItem = ui.draggable.clone().html();
                    var parentID = $(this).parent("tr").attr("id").substr(1);

                    if( $("div[id^=T"+parentID+"][idGrabacion="+idGrabacion+"]").length != 0 ) {
                        $("div[id^=T"+parentID+"][idGrabacion="+idGrabacion+"]").effect("highlight", {}, 2000);
                        return false;
                    }

                    $(this).append("<div id='T"+parentID+"G"+iterator_grabaciones[parentID]+"' idGrabacion='"+idGrabacion+"'><span>" + nameDroppedItem + "</span></div>");

                    iterator_grabaciones[parentID]++;
                }
            });
        }
    });
    
    $("#guardar_tab3").click(function (){ // TODO - [Rendimiento] - Descartar los ya grabados en una misma consulta.
        var dataString;

        $("tr[id^=T]").each(function() {
            var id = $(this).attr("id");
            var telefono = $(this).attr("idTelefono");

            $("div[id^="+id+"G]").each(function() {
                var div = $(this);
                var grabacion = $(this).attr("idGrabacion");
                
                dataString = "from=adodm&telefono=" + telefono + "&grabacion=" + grabacion;

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

function get_iterator_telefono() {
    var iterator = 1;
    $("#espacio_droppable tr[id!='null']").each(function(i) {
        if (i > 0)
            iterator++;
    });
    return iterator;
}

function get_iterator_grabaciones() {
    var iterator = new Array();

    $("#espacio_droppable tr").each(function(i){
        $(this).find("div[id!='null']").each(function(j) {
            iterator[i+1] = j+2;
        });
    });

    return iterator;
}