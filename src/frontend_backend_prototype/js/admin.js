function setupAdminPage(){    
    $.ajax({
        url: 'php/dashboard.php',
        type: 'POST',
        dataType: 'json',
        data:{type:"checkLogin"},
        success: function(response){
            // Access and use the JSON data
            var chacked = response.login;
            if(response.login == true){
                var welcome = response.username;
                $('#welcome').html(welcome);
            }else{
                loadMainContent("login.html");
            }   
        },
        error: function(xhr, status, error){
            console.error('AJAX Error:', status, error);
        }
    });
}








