function setupAdminPage(){    
    console.log("však to dělám ty píčo");
    $.ajax({
        url: 'php/dashboard.php',
        type: 'POST',
        dataType: 'json',
        data:{type:"checkLogin"},
        success: function(response){
            console.log('admin login check:', response.login);
            // Access and use the JSON data
            var chacked = response.login;
            console.log(chacked);
            if(response.login == true){
                var welcome = response.username;
                console.log("welcome: "+welcome);
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








