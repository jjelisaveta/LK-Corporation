function dodajText(naslov, opis, cena, tagovi) {
    $("#naslovId").val(naslov);
    $("#opisId").val(opis);
    $("#cenaId").val(cena);
    tagovi = JSON.parse(tagovi);
    console.log(tagovi);
    tagovi.forEach(tag => {
        console.log(tag);
        let novo = $("<button type='button' class='dugmeTag'></button>");
        novo.text(tag);
        novo.click(function () {
            var h = new Set($("#izabraniTagovi").val().split(";"));
            h.delete(this.innerHTML);
            $("#izabraniTagovi").val(Array.from(h).join(';'));
            this.parentNode.removeChild(this);
        });
        var h = $("#izabraniTagovi").val() + ";" + tag;
        $("#izabraniTagovi").val(h);
        $("#tagovi").append(novo);
    });
}

$(document).ready(function () {

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
        var h = $("#izabraniTagovi").val() + ";" + izabrano;
        $("#izabraniTagovi").val(h);
        console.log($("#izabraniTagovi").val());
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