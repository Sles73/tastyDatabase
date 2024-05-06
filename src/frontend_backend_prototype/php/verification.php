<?php 
include("connect.php");
$conn = connect();
session_start();
?>


<?php

$username = $_POST['username'];
$password = $_POST['hashedPassword'];


$stmt = $conn->query("SELECT password FROM users WHERE username = '$username'");
$user = $stmt->fetch_assoc();

if ($user) {
    // Verify the password
    if (password_verify($password, $user['password'])) {
            // Valid credentials, start session and redirect
        $_SESSION['username'] = $username;
        header("Location: ../adminPage.html"); // Redirect to dashboard or any other secure page
    } else {
        // Invalid credentials, redirect back to login page with an error message
        header("Location: ../login.html?error=1");
    }
} else {
    // User not found
    header("Location: ../login.html?error=1");
}

$conn->close();
?>
