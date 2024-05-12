var jidloJe;

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
    if (!jidlo.contains(e.target) && jidloJe == true)
    {
        jidlo.style.display = 'none';
        overlay.style.display = "none";
        jidloJe = false;
    }
}
document.addEventListener('click', jidloFuč);