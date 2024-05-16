function delButtonsSetup(json){
    if(json.login == true){
        jidloMazatelZde();
        prepareButtons()
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
    var buttons = document.getElementsByClassName("imgDeleteButton");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].style.display = "none";
      }
}

function prepareButtons(){
    var buttons = document.getElementsByClassName("imgDeleteButton");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function(event) {
            var clickedButton = event.target;
            identifyClickedButton(clickedButton);
    });
    }
}

function identifyClickedButton(clickedButton) {
    var buttonValue = clickedButton.value;
    $.ajax({
        url: "php/dashboard.php",
        type: "POST",
        data: {type:"deleteImg", imgID: buttonValue},
        success: function(response) {
            console.log(response);
            cards_sort();

        },
        error: function(xhr, status, error) {
            console.error('Request failed:', error);
        }
    });
    
  }