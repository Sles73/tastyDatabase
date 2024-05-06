$(document).ready(function(){
    $("#searchBar").on("keyup", function() {
            var search = $(this).val();
            console.log(search); // Přidejte tento řádek
            if (search != '')
            {
                $.ajax({
                    url: 'php/search.php',
                    method: 'POST',
                    data: {searchBar:search},
                    success: function(data) {
                        $('#output').html(data);
                    }
                });
            } 
            else 
            {
                $('#output').html('');
            }
        });
    });


    $(document).ready(function(){
        // When the document is ready, send an AJAX request to insert a post
        $.ajax({
            url: 'php/insert_post.php',
            type: 'POST',
            success: function(response){
                $('#result').html(response);
            },
            error: function(xhr, status, error){
                console.error('AJAX Error:', status, error);
            }
        });
    });