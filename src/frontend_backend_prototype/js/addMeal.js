function jidloZde(){
    var jidlo = document.getElementById("jidloForm");
    var overlay = document.getElementById("overlay");
    jidlo.style.display = "block";
    overlay.style.display = "block";
    event.stopPropagation();
}
function jidloFuč(e)
{
    var jidlo = document.getElementById("jidloForm");
    var overlay = document.getElementById("overlay");
    if (!jidlo.contains(e.target)) 
    {
        jidlo.style.display = 'none';
        overlay.style.display = "none";
    }
}
document.addEventListener('click', jidloFuč);