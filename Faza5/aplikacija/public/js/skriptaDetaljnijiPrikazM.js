$(document).ready(function(){
    $(".brisanje button").on('click', function (){
        let komentar = $(this).parent().parent().parent();
        let id = $(this).attr("name");
        komentar.remove();
        
        $.ajax({
            type: "POST",
            url:"/Admin/obrisiKomentar",
            data: {
                idOstvUsl: id,
            }
        }).done(function(result_html) {
            $("#results").append(result_html);
        });
    });
});
