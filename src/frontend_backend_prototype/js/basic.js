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
    console.log("banana");
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButton");
    list.style.display = "block";
    button.innerHTML = "Přihlášení &ensp;–";
}
function prihlaseniListNe()
{
    console.log("banana2");
    var list = document.getElementById("prihlaseniList");
    var button = document.getElementById("prihlaseniButton");
    list.style.display = "none";
    button.innerHTML = "Přihlášení &ensp;+";
}
function addUser()
{
    
}

