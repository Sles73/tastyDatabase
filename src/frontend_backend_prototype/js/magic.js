
$(document).ready(function(){
    // Check if the username already exists in session storage
    var curentWebsite = sessionStorage.getItem('website');

    if (curentWebsite) {
        //loadMainContent(curentWebsite);
        loadMainContent(curentWebsite);
    } else {
        // Username does not exist in session storage
        // Set the username in session storage
        console.log("default html");
        loadMainContent("main.html");
         // Load main content on page load
    }   
});

function loadMainContent(where) {
    sessionStorage.setItem('website', where);
    $.ajax({
        url: where, // URL of the main content HTML file
        type: 'GET',
        success: function(response){
            $('#vsechno').html(response); // Replace the main content with the loaded content
        },
        error: function(xhr, status, error){
            console.error('AJAX Error:', status, error);
        }
    });
    
    checkLogin(setLogin);
    switch(where){
        case "adminPage.html":
            setupAdminPage();
            break;
    }
}