$(document).ready(function() {

    $("#plus").click(function(){
        let izabrano = $("#selectId:selected");
        let novo = $("<button type='button'></button>");
        novo.val(izabrano.val());

        $("#tagovi").append(novo);

    });
});