$(document).ready(function(){
    let unetiTermini = false;
    inicijalizacija();
    
    $("#dugmePosalji").click(function(){
        if (!unetiTermini) {
            openNav();
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
});

function inicijalizacija(){
    unetiTermini = false;
}

function openNav() {
  document.getElementById("filteri").style.display = "block";
}

function closeNav() {
  document.getElementById("filteri").style.display = "none";
}

