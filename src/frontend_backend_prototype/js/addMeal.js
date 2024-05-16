var jidloJe = false;

function jidloZde(){
    var jidlo = document.getElementById("jidloForm");
    var overlay = document.getElementById("overlay");
    jidlo.style.display = "block";
    overlay.style.display = "block";
    event.stopPropagation();
    jidloJe = true;
}
function jidloFuč(e)
{
    var jidlo = document.getElementById("jidloForm");
    var overlay = document.getElementById("overlay");
    if(jidlo != null){
        if (!jidlo.contains(e.target))
        {
            jidlo.style.display = 'none';
            overlay.style.display = "none";
            jidloJe = false;
        }
    }    
}

document.addEventListener('click', jidloFuč);

checkLogin(addMealSetup);

function addMealSetup(json){
        if(json.login == true){
            jidloUkazatelZde();
        }else{
            jidloUkazatelFuč();
        }
}   

function jidloUkazatelZde(){
    var jidlo = document.getElementById("addMeal");
    jidlo.style.display = "block";
}
function jidloUkazatelFuč()
{
    var jidlo = document.getElementById("addMeal");
    jidlo.style.display = 'none';   
}

function delButtonsSetup(json){
    if(json.login == true){
        jidloMazatelZde();
    }else{
        jidloMazatelFuč();
    }
}   

function jidloMazatelZde(){
    var buttons = document.getElementsByClassName("imgDeleteButton");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].style.display = "block";
      }
}
function jidloMazatelFuč()
{ 
    console.log("provádím fuč");
    var buttons = document.getElementsByClassName("imgDeleteButton");
    for (var i = 0; i < buttons.length; i++) {
        console.log(i, "je fuč");
        buttons[i].style.display = "none";
      }
}
