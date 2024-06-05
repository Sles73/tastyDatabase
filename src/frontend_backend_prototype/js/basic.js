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
};
function setLogin(json){
    if(json.login == true){
        prihlaseniListEnable();
        let str = json.username+ " &ensp;";
        str = str.charAt(0).toUpperCase() + str.slice(1);
        document.getElementById("prihlaseniButton").innerHTML = str;
    }else{
        prihlaseniListNe();
        prihlaseniListDisable(); 
        document.getElementById("prihlaseniButton").innerHTML = "Prihlaseni &ensp;";
    }
}
function prihlaseniList() {
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButtonRozbalovac");
    list.style.display = "block";
    list.style.opacity = 1;
    button.innerHTML = "–";
}
function prihlaseniListNe()
{
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButtonRozbalovac");
    list.style.display = "none";
    list.style.opacity= 0;
    button.innerHTML = "+";
}
function prihlaseniListEnable(){
    var rozbalovac = document.getElementById("prihlaseniButtonRozbalovac");
    rozbalovac.innerHTML = "+";
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButton");
    button.addEventListener("mouseover", prihlaseniList);
    list.addEventListener("mouseleave", prihlaseniListNe);
}

function prihlaseniListDisable(){
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButton");
    button.removeEventListener("mouseover", prihlaseniList);
    list.removeEventListener("mouseleave", prihlaseniListNe);
    var rozbalovac = document.getElementById("prihlaseniButtonRozbalovac");
    rozbalovac.innerHTML = "";
}
var id;
function show_form(idForm)
{
    var objeveni = document.querySelector(idForm);
    id = objeveni;
    var overlay = document.querySelector("#overlay");
    objeveni.style.display = "block";
    objeveni.style.animation = "visible 0.2s";
    objeveni.style.opacity = 1;
    overlay.style.display = "block";
    overlay.style.animation = "visible 0.2s";
    overlay.style.opacity = 1;
    event.stopPropagation();
}
function hide_form(e)
{
    var objeveni = id;
    var overlay = document.querySelector("#overlay");
    if (objeveni && !objeveni.contains(e.target)) 
    {
        objeveni.style.animation = "visible 0.3s reverse";
        objeveni.style.display = 'none';
        objeveni.style.opacity = 0;
        overlay.style.animation = "visible 0.3s reverse";
        overlay.style.display = "none";
        overlay.style.opacity = 0;
    }
}
document.addEventListener('click', hide_form);
function darkMode()
{
    const toggleBtn = document.getElementById('darkToggle');
    document.documentElement.classList.toggle('dark');
}


