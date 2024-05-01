<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Hashing Example</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <script>

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
    </script>
</head>
<body>
    <h2>Login</h2>
    <form onsubmit="handleSubmit(event)" method="post" action="verification.php">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Submit</button>
    </form>
    <a href="index.php">main</a>
</body>
</html>
