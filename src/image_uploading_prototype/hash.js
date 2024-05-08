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