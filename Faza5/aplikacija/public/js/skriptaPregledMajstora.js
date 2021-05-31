
function ukloniMajstora(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "obrisiMajstora", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    console.log(id);
    xmlhttp.send("id=" + id);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            $("#" + id).remove();
        }
    }
}
function mail(id, email) {
    console.log($("#text" + id).val())
    window.open('mailto:' + email + '?body=' + $("#text" + id).val());
}
function detaljnijiPrikaz(id)
{
    var xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.open("POST", "prikazMajstoraAdmin", true);
    xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp2.send("id=" + id);

    xmlhttp2.onreadystatechange = function () {
        if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
            var response = xmlhttp2.responseText.split(";")[0];

        window.open(response)
//  location.href = response;
        }
    }
}