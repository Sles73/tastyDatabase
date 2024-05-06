
$(document).ready(function(){
    // Function to load main content using AJAX
    function loadMainContent() {
        $.ajax({
            url: 'main.html', // URL of the main content HTML file
            type: 'GET',
            success: function(response){
                $('#vsechno').html(response); // Replace the main content with the loaded content
            },
            error: function(xhr, status, error){
                console.error('AJAX Error:', status, error);
            }
        });
    }

    loadMainContent(); // Load main content on page load

    
});
