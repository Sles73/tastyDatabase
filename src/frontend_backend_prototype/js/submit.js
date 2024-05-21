function hashPassword(password) {
    return CryptoJS.SHA256(password).toString(CryptoJS.enc.Hex);
}

function checkLogin(outputFunction){
    $.ajax({
        url: "php/verification.php", // URL of the main content HTML file
        type: 'POST',
        data:{checkLogin:true},
        dataType: 'json',
        success: function(response){
            outputFunction(response);
        },
        error: function(xhr, status, error){
            console.error('AJAX Error:', status, error);
        }
    });
}

function goToAdmin(json,login = false){
    if(json.login == true){
        loadMainContent("main.html");
        hide(new Event('click'));
    }else{
        if(login){
            const error = document.getElementById("prihlaseniWarning");
            //error.textContent = "Chybné jméno nebo heslo."; 
        }
        show('prihlaseni');
    }
}

function handleSubmit(event) {
    event.preventDefault(); // Prevent form submission
    const form = event.target;
    const password = form.password.value;
    const username = form.username.value;

    // Hash the password
    const hashedPassword = hashPassword(password);

    // Submit the form
    $.ajax({
        url: "php/verification.php", // URL of the main content HTML file
        type: 'POST',
        data: {username: username, hashedPassword:  hashedPassword},
        success: function(response){
            goToAdmin(response,true);
        },
        error: function(xhr, status, error){
            console.error('AJAX Error:', status, error);
        }
    });
}
