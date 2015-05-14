$(document).ready(function(){
    $('.modal-trigger').leanModal();
});

function borrarContacto(url) {
    $.ajax({
        url: url,
        context: document.body,
        success: function (data) {
            actualizarListado(data);
        }
    });
}

function actualizarListado(responseXML) {
    if ($("eliminado", responseXML).text() === "1") {
        $("#"+($("mail", responseXML).text())).remove();
    } else {
        window.alert("Error: no se pudo eliminar a " + mail);
    }
}
