$(document).ready(function() {
	inicijalizacija();

    $("#plus").click(function(){
        let izabrano = $("#selectId :selected");
	if (izabrano.text()=="--Izaberi--") return;
        let t = [];
        if (localStorage.getItem("tagovi")!="null"){
            t = JSON.parse(localStorage.getItem("tagovi"));
	} 
        alert("isao");
        if (!t.includes(izabrano.text())){
            let novo = $("<button type='button'></button>");
            novo.text(izabrano.val());
            alert(izabrano.val());
            novo.addClass("plusTag");
            novo.bind("click", izbaci);
            $("#tagovi").append(novo);
            
            t.push(izabrano.text());
            let sadrzaj = "";
            for (let i = 0; i < t.length; i++) {
                if (sadrzaj == ""){
                        sadrzaj += t[i];
                } else {
                        sadrzaj = sadrzaj + "#" + t[i];
                }
            }
            localStorage.setItem("tagovi", JSON.stringify(t));
            $("#izabraniTagovi").val(sadrzaj);
        }       
       
    });
	
	function izbaci(){
		let dugmad = $(".plusTag");
		let t = JSON.parse(localStorage.getItem("tagovi"));
		let obrisati = $(this).text();
		$(this).remove();
		for (let i = 0; i < dugmad.length; i++){
			if (dugmad.eq(i).text() == obrisati){
				t.splice(i, 1);
				localStorage.setItem("tagovi", JSON.stringify(t));
				return;
			}
		}
		
	}


	function inicijalizacija(){
		localStorage.setItem("tagovi", null);
	}
});