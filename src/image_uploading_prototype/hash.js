function hashPassword(password) {
    return CryptoJS.SHA256(password).toString(CryptoJS.enc.Hex);
}

function handleSubmit(event) {
    event.preventDefault(); // Prevent form submission
    const form = event.target;
    const password = form.password.value;

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

    // Submit the form
    form.submit();
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