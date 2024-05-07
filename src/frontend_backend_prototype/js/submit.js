
function hashPassword(password) {
    return CryptoJS.SHA256(password).toString(CryptoJS.enc.Hex);
}

function checkLogin(){
    $.ajax({
        url: "php/verification.php", // URL of the main content HTML file
        type: 'POST',
        data:{checkLogin:true},
        dataType: 'json',
        success: function(response){
            console.log('Received JSON data:', response);
            // Access and use the JSON data
            var chacked = data.login;
            console.log('Chacked login:', chacked);
        },
        error: function(xhr, status, error){
            console.error('AJAX Error:', status, error);
        }
    });
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
            loadMainContent("adminPage.html");
        },
        error: function(xhr, status, error){
            console.error('AJAX Error:', status, error);
        }
    });
}

function handleSubmitForUserAdd(event) {

    event.preventDefault(); // Prevent form submission
    const form = event.target;
    const password = form.password.value;
    const passwordAgain = form.passwordAgain.value;

    if(password != passwordAgain){
        const error = document.getElementById("warning");
        error.textContent = "Passwords are not the same!"; 

    }else{
    // Hash the password
    const hashedPassword = hashPassword(password);

    // Create a hidden input field to store the hashed password
    const hashedPasswordInput = document.createElement('input');
    hashedPasswordInput.type = 'hidden';
    hashedPasswordInput.name = 'hashedPassword';
    hashedPasswordInput.value = hashedPassword;

    // Append the hidden input field to the form
    form.appendChild(hashedPasswordInput);

    // Remove the password input field from the form
    form.removeChild(form.querySelector('#password'));
    form.removeChild(form.querySelector('#passwordAgain'));

    // Submit the form
    form.submit();
    }
}

function handleSubmitForUserModify(event) {
    
    // Get the form element
    var form = document.getElementById("modifyUser");
    var submitButtonValue = event.submitter.name;

    if(submitButtonValue == "changePassword"){
        event.preventDefault();
        const form = event.target;
    const password = form.password.value;
    const passwordAgain = form.passwordAgain.value;

    if(password != passwordAgain){
        const error = document.getElementById("text");
        error.textContent = "Passwords are not the same!"; 

    }else{
    // Hash the password
    const hashedPassword = hashPassword(password);

    // Create a hidden input field to store the hashed password
    const hashedPasswordInput = document.createElement('input');
    hashedPasswordInput.type = 'hidden';
    hashedPasswordInput.name = 'hashedPassword';
    hashedPasswordInput.value = hashedPassword;

    // Append the hidden input field to the form
    form.appendChild(hashedPasswordInput);

    // Remove the password input field from the form
    form.removeChild(form.querySelector('#password'));
    form.removeChild(form.querySelector('#passwordAgain'));

    // Submit the form
    form.submit();
    }
    }
}