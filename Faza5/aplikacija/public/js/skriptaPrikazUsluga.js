$(document).ready(function () {
    let unetiTermini;
    let rez;
    inicijalizacija();

    uslugeSve = JSON.parse(localStorage.getItem('usluge'));
    terminiSvi = JSON.parse(localStorage.getItem('termini'));
    terminiMapa = new Map();
    terminiSvi.forEach(t => {
        if (terminiMapa.has(t.idMaj)) {
            var val = terminiMapa.get(t.idMaj);
        } else {
            var val = [];
        }
        val.push(Date.parse(t.vreme.date));
        terminiMapa.set(t.idMaj, val);
    })

    dohvatiKljuc();

    console.log(terminiMapa);
    $("#dugmePosalji").click(function () {
        if (!unetiTermini) {
            openNav();
            return;
        }

        console.log("slanje");
        var usl = [];
        var ozn = $("#filteri input:checkbox:checked");
        var dan = $("#termin").val();
        var oznaceni = [];
        ozn.each(index => {
            oznaceni.push(Date.parse(dan + " " + ozn[index].id + ":00:00"));
        })
        var novaMapa = new Map();
        terminiMapa.forEach((value, key) => {
            value = value.filter(t => oznaceni.includes(t));
            novaMapa.set(key, value);
        });
        var o = $("#poljeZaUsluge input:checkbox:checked");
        o.each(index => {
            console.log(o[index].id.substr(0, 2));
            if (o[index].id.substr(0, 2) === "cb") {
                var id = o[index].id.substr(2, o[index].id.length - 2);
                var majstor = uslugeSve.find(u => u.idUsl == id).majstor;
                var niz = novaMapa.get(parseInt(majstor))
                var ter = [];
                niz.forEach(e => {
                    var idter = terminiSvi.find(elem => Date.parse(elem.vreme.date) == e).idTer;
                    ter.push(idter);
                })
                usl.push({
                    'id': id,
                    'ter': ter
                });
            }
        });
        opis = $("#opisProblema").val();
        console.log(JSON.stringify(usl));
        $.ajax({
            type: "POST",
            url: "/Klijent/rezervacija",
            data: {
                zahtevi: JSON.stringify(usl),
                opis: opis,
                kljuc: kljuc
            }
        }).done(function (result_html) {
            if (result_html === "OK")
                window.location = '../pretrazivanje';
        });
        /*slanje mejlova i upis zahteva u bazu*/
    });

    $("#dugmePretrazi").click(function () {
        if (!unetiTermini) {
            let oznaceni = $("input:checkbox:checked");
            if (oznaceni.length == 0) return;
            unetiTermini = true;
            $("#dugmePosalji").text("Rezerviši");
            return;
            /*filtriranje i sortiranje*/
        }
        var o = $("#filteri input:checkbox:checked");
        console.log(o);
        var dan = $("#termin").val();
        var oznaceni = [];
        o.each(index => {
            oznaceni.push(Date.parse(dan + " " + o[index].id + ":00:00"));
        })
        console.log(oznaceni);
        usluge = dohvatiUsluge();
        var sortSelektovan = $("#sortiranje").children("option:selected").val()[1];
        var cena = $("#SkalaCena").val();
        var preporuka = $("#ocena").val();
        var vreme = $("#vremeOdziva").val();
        sort(sortSelektovan, filter(oznaceni, cena, preporuka, vreme));
    });


    //usluga(cena, id, majstor, naslov, opis, preporuka)
    // var usluge = JSON.parse(localStorage.getItem('usluge'));
    // $(".uslugaKomponenta").remove();
    // usluge.forEach(u => {
    //     $("#poljeZaUsluge").append(usluga(u.cena, u.id, u.majstori, u.naslov, u.opis, u.preporuke));
    // });

});

let uslugeSve;
let terminiSvi;
let terminiMapa;
let kljuc;

function filter(oznaceni, cena, preporuka, vreme) {
    usluge = dohvatiUsluge();
    usluge = usluge.filter(u => {
        console.log('slobodan ');
        var slobodan = terminiMapa.get(parseInt(u.majstor));
        if (slobodan == null)
            return false;
        console.log(slobodan);
        var x = false;
        for (let o of oznaceni) {
            if (slobodan.includes(o)) {
                x = true;
                break;
            }
        }
        return x;
    });

    usluge = usluge.filter(u => parseInt(u.cena) <= cena);
    usluge = usluge.filter(u => {
        var p = parseInt(u.preporuke.substr(0, u.preporuke.length - 1));
        return p >= preporuka;
    });
    usluge = usluge.filter(u => {
        var vr = u.vremeOdgovora.split(":");
        var sekunde = 0;
        var mnozilac = 1;
        for (i = vr.length - 1; i >= 0; i--) {
            sekunde += parseInt(vr[i]) * mnozilac;
            mnozilac *= 60;
        }
        return sekunde <= vreme;
    });
    return usluge;
}

function sort(znak, usluge) {
    usluge.sort((a, b) => {
        if (znak == 1)
            return a.cena - b.cena;
        if (znak == 2)
            return b.cena - a.cena;
        if (znak == 3)
            return a.preporuke - b.preporuke;
        if (znak == 4)
            return b.preporuke - a.preporuke;
        if (znak == 5)
            return a.vremeOdgovora - b.vremeOdgovora;
        return b.vremeOdgovora - a.vremeOdgovora;
    })
    updateUsluge(usluge)
}

function dohvatiUsluge() {
    return uslugeSve;
}

function updateUsluge(usluge) {
    $(".uslugaKomponenta").remove();
    usluge.forEach(u => {
        $("#poljeZaUsluge").append(usluga(u.cena, u.idUsl, u.majstori, u.naslov, u.opis, u.preporuke, u.vremeOdgovora));
    });
}

function inicijalizacija() {
    unetiTermini = false;
    //dohvti sve usluge sa strane i posalji ajax da se za sve majstore svih usluga dohvate slobodni termini
    let usluge = [];
    let sveUsluge = $(".uslugaTabela");
    let nizMajstora = [];
    for (let i = 0; i < sveUsluge.length; i++) {
        let tren = sveUsluge.eq(i);
        if (!nizMajstora.includes(tren.find(".detaljnijeMajstor").attr("id").trim())) {
            nizMajstora.push(tren.find(".detaljnijeMajstor").attr("id").trim());
        }
        usluge.push({
            idUsl: tren.attr("id").trim(),
            naslov: tren.find("h1").text().trim(),
            opis: tren.find("p").text().trim(),
            cena: tren.find(".cenaUsluge").text().trim(),
            preporuke: tren.find(".preporuke").text().trim(),
            vremeOdgovora: tren.find(".vremeOdgovora").text().trim(),
            majstor: tren.find(".detaljnijeMajstor").attr("id").trim()

        });
    }

    let majstori = nizMajstora.join("_");
    let termini = dohvatiSlobodneTermine(majstori);

    localStorage.setItem("usluge", JSON.stringify(usluge));

}

function dohvatiSlobodneTermine(nizMajstora) {
    $.ajax({
        type: "POST",
        url: "/Klijent/dohvatiSlobodneTermine",
        data: {
            majstori: nizMajstora
        }
    }).done(function (result_html) {
        rez = result_html;
        localStorage.setItem("termini", rez);
    });
}

function dohvatiKljuc() {
    $.ajax({
        type: "GET",
        url: "/Klijent/dohvatiIdentifikator",
    }).done(function (result_html) {
        rez = result_html.split("\n")[1];
        kljuc = parseInt(rez);
    });
}

function openNav() {
    document.getElementById("filteri").style.display = "block";
}

function closeNav() {
    document.getElementById("filteri").style.display = "none";
}


/*
cena: "150001"
idUsl: "19"
majstor: "1"
naslov: "Popravka dobro"
opis: "Ja sam mnogo dobro"
preporuke: "0%"
vremeOdgovora: "02:25"


 */
function usluga(cena, id, majstor, naslov, opis, preporuka, vremeOdgovora) {
    return '<div class="row uslugaKomponenta">\n' +
        '    <div class="offset-1 col-10 polje">\n' +
        '        <table class="uslugaTabela" id="' + id + '">\n' +
        '            <tr>\n' +
        '                <td id="userimg"><img src="#"></td>\n' +
        '                <td width="60%">\n' +
        '                    <h1>\n' +
        '                        ' + naslov + '\n' +
        '                    </h1>\n' +
        '                    <hr/>\n' +
        '                    <p>\n' +
        '                        ' + opis + '\n' +
        '                    </p>\n' +
        '                </td>\n' +
        '                <td class="statistika" width="25%">\n' +
        '                    <h3>\n' +
        '                        Majstora preporučuje: <b class="preporuke"> ' + preporuka + '</b> <br>\n' +
        '                        Prosečno vreme odgovora: <b class="vremeOdgovora">' + vremeOdgovora + '</b> <br>\n' +
        '                        Cena usluge: <b class="cenaUsluge"> ' + cena + '</b>\n' +
        '                    </h3>\n' +
        '                </td>\n' +
        '            </tr>\n' +
        '            <tr>\n' +
        '                <td colspan="3" width="100%">\n' +
        '                    <div class="detaljnijeMajstor" id="' + majstor + '">\n' +
        '                        <button type="button" onclick="window.location=\'detaljnijiPrikazMajstora.html\';">\n' +
        '                            Prikaži profil majstora\n' +
        '                        </button>\n' +
        '                    </div>\n' +
        '                    <div class="odbij">\n' +
        '                        <button>\n' +
        '                            <label for="cb">Odaberi</label>\n' +
        '                            <input type="checkbox" id="cb' + id + '">\n' +
        '                        </button>\n' +
        '                    </div>\n' +
        '                </td>\n' +
        '            </tr>\n' +
        '        </table>\n' +
        '    </div>\n' +
        '</div>\n'
}
