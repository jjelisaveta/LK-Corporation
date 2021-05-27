function prihvati(button) {
    id = button.id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "odobriMajstora", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + id);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var response = xmlhttp.responseText.split("\n")[0].substr(0, 2);
            if (response.localeCompare("OK") == 0) {
                var idr = "red" + id;
                console.log('odgovor ' + idr);
                $("#" + idr).remove();
            }
        }
    }
}

function ukloni(button) {
    id = button.id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "ukloniMajstora", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + id);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var response = xmlhttp.responseText.split("\n")[0].substr(0, 2);
            if (response.localeCompare("OK") == 0) {
                var idr = "red" + id;
                console.log('odgovor ' + idr);
                $("#" + idr).remove();
            }
        }
    }
}