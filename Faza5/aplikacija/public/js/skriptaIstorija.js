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
