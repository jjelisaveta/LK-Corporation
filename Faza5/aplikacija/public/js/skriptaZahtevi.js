function prihvati(id) {
    console.log("prihvati " + id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "odobriZahtev", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("idZah=" + id);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var responses = xmlhttp.responseText.split("\n");
            var response = responses[0].substr(0, 2);
            if (response.localeCompare("OK") == 0) {
                var idr = "row" + id;
                console.log('odgovor ' + idr);
                $("#" + idr).remove();
                var ids = JSON.parse(responses[1]);
                ids.forEach(val => {
                    var idr = "row" + val;
                    console.log('odgovor ' + idr);
                    $("#" + idr).remove();
                });
            }
        }
    }
}

function odbij(id) {
    console.log("odbi " + id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "odbijZahtev", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("idZah=" + id);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var response = xmlhttp.responseText.split("\n")[0].substr(0, 2);
            if (response.localeCompare("OK") == 0) {
                var idr = "row" + id;
                console.log('odgovor ' + idr);
                $("#" + idr).remove();
            }
        }
    }
}