$(document).ready(function() {
    $(".imgDeleteButton").on("click", function() {
      var clickedButton = $(this); // Use $(this) to get the clicked button element
      identifyClickedButton(clickedButton);
    });
  });
  
  function identifyClickedButton(clickedButton) {
    // Access button properties and perform actions here
    var buttonValue = clickedButton.val();
    
    console.log("Clicked button:", buttonValue); // Example usage, log the text content
  }



/*
        $.ajax({
            url: "php/dashboard.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('Request failed:', error);
            }
        });
    });
});*/