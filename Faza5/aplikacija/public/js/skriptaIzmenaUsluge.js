$(document).ready(function () {
    $("#izabraniTagovi").val("");
    $(".dugmeTag").click(function () {
        var h = new Set($("#izabraniTagovi").val().split(";"));
        h.delete(this.innerHTML);
        $("#izabraniTagovi").val(Array.from(h).join(';'));
        this.parentNode.removeChild(this);
    });
    let dugmad = $(".dugmeTag");
    $.each(dugmad, (key, value) => {
        if ($("#izabraniTagovi").val().length > 3)
            var h = $("#izabraniTagovi").val() + ";" + dugmad[key].innerHTML;
        else
            var h = $("#izabraniTagovi").val() + dugmad[key].innerHTML;
        $("#izabraniTagovi").val(h);
    });
    $("#plus").click(function () {
        let izabrano = $("#selectId").val();
        var x = false;
        if (izabrano == "--Izaberi--") {
            return;
        }
        let dugmad = $(".dugmeTag");
        $.each(dugmad, (key, value) => {
            console.log(dugmad[key].innerHTML);
            if (dugmad[key].innerHTML === izabrano) {
                x = true;
                return false; // breaks
            }
        });
        if (x == true)
            return;
        let novo = $("<button type='button' class='dugmeTag'></button>");
        if ($("#izabraniTagovi").val().length > 3)
            var h = $("#izabraniTagovi").val() + ";" + izabrano;
        else
            var h = $("#izabraniTagovi").val() + izabrano;
        $("#izabraniTagovi").val(h);
        novo.text(izabrano);
        novo.click(function () {
            var h = new Set($("#izabraniTagovi").val().split(";"));
            h.delete(this.innerHTML);
            $("#izabraniTagovi").val(Array.from(h).join(';'));
            this.parentNode.removeChild(this);
        });
        $("#tagovi").append(novo);
    });
});