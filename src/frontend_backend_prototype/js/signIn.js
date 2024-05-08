function jeToTam(){
    var prihlaseni = document.getElementById("prihlaseni");
    var overlay = document.getElementById("overlay");
    prihlaseni.style.display = "block";
    overlay.style.display = "block";
}
function aJeFuč(e)
{
    var prihlaseni = document.getElementById("prihlaseni");
    var overlay = document.getElementById("overlay");
    if (!prihlaseni.contains(e.target)) 
    {
        prihlaseni.style.display = 'none';
        overlay.style.display = "none";
    }
}
document.addEventListener('click', aJeFuč);