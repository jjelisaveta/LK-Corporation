const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const icon = searchWrapper.querySelector(".icon");
let linkTag = searchWrapper.querySelector("a");
let webLink;
$("#nemaRez").hide();
for (let i = 0; i < jArray.length; i++) {
    $("#tagovi").append('<button ' + " id=" + trim(jArray[i]) + '>' + jArray[i] + '</button>');
    $("#" + trim(jArray[i])).hide();
}
// if user press any key and release
inputBox.onkeyup = (e) => {
    for (let i = 0; i < jArray.length; i++) {
        $("#" + trim(jArray[i])).hide();
    }
    let userData = e.target.value; //user enetered data
    let emptyArray = [];
    if(userData){
        emptyArray = jArray.filter((data)=>{                        //ovde sad lista svih imena ekstrakuj u dugmad
            return data.toLocaleLowerCase().includes(userData.toLocaleLowerCase()); 
        });
        if(userData.length != 0 && emptyArray.length == 0){
            $("#nemaRez").text("usluga " + userData + " ne postoji");
            $("#nemaRez").show();
        }else{
             $("#nemaRez").hide();
        }
        for(let i = 0; i < emptyArray.length; i++){
            $("#" + trim(emptyArray[i])).show();
        }
    }
}

$("button").click(function(){
    let ok = false;
    for (let i = 0; i < jArray.length; i++){
        if(trim(jArray[i]) == $(this).attr("id")){
            ok = true;
            break;
        }
    }
    if(ok)
        window.location.href = "prikazUsluga/" + $(this).attr("id");
})

function trim(rec){
        let sol = "";
        for(let i = 0; i < rec.length; i++){
            if(rec[i] == ' '){
                sol += "_";
            }else{
                sol += rec[i];
            }
        }
        return sol;
}

