
$(document).ready(function(){
    // Function to load main content using AJAX
    
    console.log("ajax triger");
    loadMainContent("main.html"); // Load main content on page load

    
});

function loadMainContent(where) {
    console.log(where);
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
}