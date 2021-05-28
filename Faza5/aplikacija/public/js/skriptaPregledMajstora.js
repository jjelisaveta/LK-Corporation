function ukloniMajstora(param)
{
    var roditelj = param.parentNode.parentNode.parentNode;
    var id=param.parentNode.getElementsByClassName("hidden")[0].value;
  
    $(roditelj).remove()
    
    var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.open("POST", "obrisiMajstora", true);
    xmlhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp1.send("id="+id);
    xmlhttp1.onreadystatechange = function () {
        if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
          
        }
    }
}