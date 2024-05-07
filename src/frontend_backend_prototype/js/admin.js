window.onload = function(){    
    console.log("však to dělám ty píčo");
    $.ajax({
        url: 'php/dashboard.php',
        type: 'POST',
        dataType: 'json',
        data:{checkLogin:true},
        success: function(response){
            console.log('admin login check:', response.login);
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

function post(input_type){
    console.log("post type " + input_type);
    $.ajax({
        url: "php/dashboard.php", // URL of the main content HTML file
        type: 'POST',
        data:{type:input_type},
        input_type: "json",
        success: function(response){
            console.log("response");

            response_action(response);
        },
        error: function(xhr, status, error){
            console.error('AJAX Error:', status, error);
        }
    });
}

function response_action(json){
    console.log(json);
}