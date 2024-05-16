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
};
function prihlaseniList() {
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButton");
    list.style.display = "block";
    button.innerHTML = "Přihlášení &ensp;–";
}
function prihlaseniListNe()
{
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButton");
    list.style.display = "none";
    button.innerHTML = "Přihlášení &ensp;+";
}

function showAddUser(){
    console.log("banana");
    var objeveni = document.getElementById("addUser");
    var overlay = document.getElementById("overlay");
    objeveni.style.display = "block";
    overlay.style.display = "block";
    event.stopPropagation();
}
function hideAddUser(e)
{
    console.log("banana2");
    var objeveni = document.getElementById("addUser");
    var overlay = document.getElementById("overlay");
    if (!objeveni.contains(e.target)) 
    {
        objeveni.style.display = 'none';
        overlay.style.display = "none";
    }
}
document.addEventListener('click', hideAddUser);
