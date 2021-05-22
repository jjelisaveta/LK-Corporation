function changeDate(date) {
    $("#datuminput").val(date);
}

function promenaKalendar(input) {
    var datum = input.value;
    resetTermine();
    var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.open("GET", "dohvatiRadneTermine/" + datum, true);
    xmlhttp1.send();
    xmlhttp1.onreadystatechange = function () {
        if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
            var x = JSON.parse(xmlhttp1.responseText.split('\n')[0]);
            console.log(x);
            for (id in x) {
                updateTermin(x[id]);
            }
        }
    }
    var xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.open("GET", "dohvatiRezervacije/" + datum, true);
    xmlhttp2.send();
    xmlhttp2.onreadystatechange = function () {
        if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
            var xx = JSON.parse(xmlhttp2.responseText.split('\n')[0]);
            console.log(xx);
            for (id in xx) {
                rezervisi(xx[id]);
            }
        }
    }
}


function updateTermin(id) {
    console.log(id);
    $("#" + id).toggleClass("terminda");
}

function rezervisi(id) {
    console.log(id);
    $("#" + id).toggleClass("terminzauzet");
}

function resetTermine() {
    $(".dugme").attr("class", "btn-lg col-3 col-md-2 dugme terminne");
    console.log("resetova");
}

function promeniTermin(objButton) {
    //dugme1
    var id = objButton.id.substr(5, objButton.id.length - 4);
    console.log(id);
    if (objButton.classList.contains("terminzauzet")) {
        return;
    }
    var usluga = "dodajRadniTermin";
    if (objButton.classList.contains("terminda")) {
        usluga = "skiniRadniTermin";
    }
    var xmlhttp = new XMLHttpRequest();
    var datumVreme = $("#datuminput").val();
    xmlhttp.open("POST", usluga, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("datum=" + datumVreme + "&index=" + id);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var response = xmlhttp.responseText.split("\n")[0].substr(0, 2);
            if (response.localeCompare("OK") == 0) {
                console.log("evo odgovora");
                updateTermin("dugme" + id);
            }
        }
    }
}
