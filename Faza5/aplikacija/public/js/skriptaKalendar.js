function changeDate(date) {
    $("#datuminput").val(date);
}

function promenaKalendar(input) {
    var datum = input.value;
    resetTermine();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "dohvatiRadneTermine/" + datum, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var x = JSON.parse(xmlhttp.responseText.split('\n')[0]);
            console.log(x);
            for (id in x) {
                updateTermin(x[id]);
            }
        }
    }
}


function updateTermin(id) {
    console.log(id);
    $("#" + id).toggleClass("terminda");
}

function resetTermine() {
    $(".dugme").attr("class", "btn-lg col-3 col-md-2 dugme terminne");
    console.log("resetova");
}