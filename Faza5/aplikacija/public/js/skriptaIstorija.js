function pogasi(){
let textovi=[];
   
textovi =document.getElementsByClassName('komentarinput');

    for (let i=0;i<textovi.length;i++)
{
    
    if (textovi[i].value!='') {
        textovi[i].disabled=true;
  var dugme= textovi[i].parentNode.parentNode.getElementsByClassName("komentardugme")[0].parentNode.removeChild(
      textovi[i].parentNode.parentNode.getElementsByClassName("komentardugme")[0]);
  }  
}

}
function myFunction(objButton) {
      
    var label = objButton.parentNode.parentNode.getElementsByClassName("ocenaLabel")[0];
    var da = objButton.parentNode.parentNode.getElementsByClassName("ocenaDugme")[0];
    var ne = objButton.parentNode.parentNode.getElementsByClassName("ocenaDugme")[1];
    var hid=objButton.parentNode.parentNode.getElementsByClassName("hidden3")[0];
    
    label.innerHTML = objButton.innerHTML;
   
    da.parentNode.removeChild(da);
    ne.parentNode.removeChild(ne);
    
    if (label.innerHTML == "+") {
        label.style.color = "green"
        hid.value=1;
      
    } else {
        label.style.color = "red"
        hid.value=0;
  
    }
    var xmlhttp1 = new XMLHttpRequest();
   
}
function deleteTextArea(button) {
    var element = button.parentNode.parentNode.getElementsByClassName("komentarinput")[0].disabled = true;

    button.parentNode.removeChild(button);
}

function ukloniPopravku(button) {
    var zahtev = button.parentNode.parentNode.parentNode.parentNode.parentNode;
    zahtev.parentNode.removeChild(zahtev);
    console.log(zahtev);
}

function onTestChange(area) {
    var key = window.event.keyCode;
    // If the user has pressed enter
    if (key === 13) {
        area.readOnly = "false";
    }
}

