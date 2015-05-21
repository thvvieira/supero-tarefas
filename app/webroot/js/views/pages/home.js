//Js Pages/home

$(document).ready(function () {
    $(".delete-item").draggable();
    $("#trash").droppable({
        drop: function(event, ui) {
            var id = ui.helper[0].id;
            alert("Item removido com succeso!");
            $("#t"+id).remove();
            //Entra requisição via ajax.
        }
    });
});