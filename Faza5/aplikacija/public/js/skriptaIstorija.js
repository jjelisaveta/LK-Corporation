$(document).ready(function (){
    var zah = $(".istorija");
    if (zah.length == 0) {
        $(".nemaRezultata").prop('hidden', false);
    }
});
function pogasi() {
    let textovi = [];
    textovi = document.getElementsByClassName('komentarinput');
    for (let i = 0; i < textovi.length; i++) {
        if (textovi[i].value != '') {
            textovi[i].disabled = true;
            var dugme = textovi[i].parentNode.parentNode.getElementsByClassName("komentardugme")[0].parentNode.removeChild(
                textovi[i].parentNode.parentNode.getElementsByClassName("komentardugme")[0]);
        }
    }

}

function myFunction(objButton) {

    var label = objButton.parentNode.parentNode.getElementsByClassName("ocenaLabel")[0];
    var da = objButton.parentNode.parentNode.getElementsByClassName("ocenaDugme")[0];
    var ne = objButton.parentNode.parentNode.getElementsByClassName("ocenaDugme")[1];
    var id = objButton.parentNode.parentNode.getElementsByClassName("hidden2")[0].value;
    var ocena;

    label.innerHTML = objButton.innerHTML;

    da.parentNode.removeChild(da);
    ne.parentNode.removeChild(ne);

    if (label.innerHTML == "+") {
        label.style.color = "green"
        ocena = 1;

    } else {
        label.style.color = "red"
        ocena = 0;

    }
    var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.open("POST", "sacuvajOcenu", true);
    xmlhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp1.send("ocena=" + ocena + "&id=" + id);
    xmlhttp1.onreadystatechange = function () {
        if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {

        }
    }
}

function deleteTextArea(button) {
    var element = button.parentNode.parentNode.getElementsByClassName("komentarinput")[0].disabled = true;
    button.parentNode.removeChild(button);
}

function ukloniPopravku(button) {
    var zahtev = button.parentNode.parentNode.parentNode.parentNode.parentNode;
    var id = button.parentNode.getElementsByClassName("hiddenU")[0].value;

    zahtev.parentNode.removeChild(zahtev);
    var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.open("POST", "obrisiIstorija", true);
    xmlhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp1.send("id=" + id);
    xmlhttp1.onreadystatechange = function () {
        if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
            var zah = $(".istorija");
            //alert(zah.length);
            if (zah.length == 0) {
                //alert(kurcina);
                $(".nemaRezultata").prop('hidden', false);
                //alert( $(".nemaRezultata").prop('hidden'));
            }
        }
    }
}

function onTestChange(area) {
    var key = window.event.keyCode;
    // If the user has pressed enter
    if (key === 13) {
        area.readOnly = "false";
    }
}

