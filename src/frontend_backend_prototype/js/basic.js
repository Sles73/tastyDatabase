window.onload = function() {
    var date = new Date();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ampm + ' ' + date.getDate() + '.' + (date.getMonth()+1) + '.' + ' ' + date.getFullYear();
    document.getElementById('time').innerHTML = strTime;
    var list = document.getElementById("prihlaseniList");
    list.style.display = "none";
    var modiy = document.getElementById("modifyUser");
    modiy.style.display = "none";
};
function setLogin(json){
    console.log("triggered");
    if(json.login == true){
        prihlaseniListEnable();
    }else{
        prihlaseniListNe();
        prihlaseniListDisable(); 
    }
}
function prihlaseniList() {
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButtonRozbalovac");
    list.style.display = "block";
    button.innerHTML = "–";
}
function prihlaseniListNe()
{
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButtonRozbalovac");
    list.style.display = "none";
    button.innerHTML = "+";
}
function prihlaseniListEnable(){
    var rozbalovac = document.getElementById("prihlaseniButtonRozbalovac");
    rozbalovac.innerHTML = "+";
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButton");
    button.addEventListener("mouseover", prihlaseniList);
    list.addEventListener("mouseleave", prihlaseniListNe);
    console.log("Events enabled");
}

function prihlaseniListDisable(){
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButton");
    button.removeEventListener("mouseover", prihlaseniList);
    list.removeEventListener("mouseleave", prihlaseniListNe);
    console.log("Events enabled");
    var rozbalovac = document.getElementById("prihlaseniButtonRozbalovac");
    rozbalovac.innerHTML = "";
}
var id;
function show(idForm)
{
    var objeveni = document.getElementById(idForm);
    id = objeveni;
    var overlay = document.getElementById("overlay");
    objeveni.style.display = "block";
    overlay.style.display = "block";
    event.stopPropagation();
}
function hide(e)
{
    var objeveni = id;
    var overlay = document.getElementById("overlay");
    if (objeveni && !objeveni.contains(e.target)) 
    {
        objeveni.style.display = 'none';
        overlay.style.display = "none";
    }
}
document.addEventListener('click', hide);