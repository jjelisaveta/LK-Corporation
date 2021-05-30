
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