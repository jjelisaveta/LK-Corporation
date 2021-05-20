$(document).ready(function() {

    $("#plus").click(function(){
        let izabrano = $("#selectId :selected");
		if (izabrano.text()=="--Izaberi--") return;
		
        let novo = $("<button type='button'></button>");
        novo.text(izabrano.val());
		novo.bind("click", izbaci);
        $("#tagovi").append(novo);
		
		let sadrzaj = $("#izabraniTagovi").val();
		if (sadrzaj==null || sadrzaj==""){
			sadrzaj = izabrano.text();
		} else {
			sadrzaj +="#" + izabrano.text();
		}
		alert(sadrzaj);
		$("#izabraniTagovi").val(sadrzaj);

    });
	

	function izbaci(){
		$(this).remove();
	}
});