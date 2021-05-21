function changeDate(date) {
    $("#datuminput").val(date);
}

function promenaKalendar(input) {
    var datum = input.value;
    resetTermine();
    // var xmlhttp = new XMLHttpRequest();
    // var base_url = '<?php echo base_url(); ?>'
    // $.ajax({
    //     url: base_url + 'kalendar/' + datum,
    //     type: 'POST',
    //     data: datum,
    //     success: function (datum) {
    //         alert(datum); // here what you want to do with response
    //     }
    // });
    // $.ajax({
    //     method: "GET",
    //     url: "kalendar/" + datum,
    //     async: false
    // }).done(function () {
    //     console.log("zavrseno")
    // });
    // // var niz = window.location.split("/");
    var str = window.location.href.split("/");
    if (str[str.length - 1] != "kalendar") {
        window.location = datum;
    } else {
        window.location = "kalendar/" + datum;
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