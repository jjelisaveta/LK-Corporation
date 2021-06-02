$(document).ready(function(){
    let unetiTermini;
    let rez;
    inicijalizacija();
    
    $("#dugmePosalji").click(function(){
        if (!unetiTermini) {
            openNav();
            return;
        };
        /*slanje mejlova i upis zahteva u bazu*/
    });
    
    $("#dugmePretrazi").click(function(){
        if (!unetiTermini){
            let oznaceni = $("input:checkbox:checked");
            if (oznaceni.length == 0) return;
            unetiTermini = true;
            $("#dugmePosalji").text("Rezerviši");
            /*filtriranje i sortiranje*/
        }
    });
    
   $(".ddd").click(function (){
        let id = $(this).attr("id");
        alert(id);
        $.ajax({
            type: "POST",
            url:"/Klijent/prikazMajstora",
            data: {
                idMaj: id
            }
        }).done(function(result_html) {
            window.open(result_html);
        });
    });
});

function inicijalizacija(){
    unetiTermini = false;
    //dohvti sve usluge sa strane i posalji ajax da se za sve majstore svih usluga dohvate slobodni termini
    let usluge = [];
    let sveUsluge = $(".uslugaTabela");
    let nizMajstora = [];
    for (let i = 0; i < sveUsluge.length; i++) {
        let tren = sveUsluge.eq(i);
        if (!nizMajstora.includes(tren.find(".detaljnijeMajstor").attr("id").trim())){
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

function dohvatiSlobodneTermine(nizMajstora){
    $.ajax({
        type: "POST",
        url:"/Klijent/dohvatiSlobodneTermine",
        data: {
            majstori: nizMajstora
        }
    }).done(function(result_html) {
        rez = result_html;
        localStorage.setItem("terimini", rez);
    });
}



function openNav() {
  document.getElementById("filteri").style.display = "block";
}

function closeNav() {
  document.getElementById("filteri").style.display = "none";
}

