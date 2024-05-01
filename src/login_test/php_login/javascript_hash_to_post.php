<?php 
include("connect.php");
session_start();
?>

<?php
/*
// MANUAL USER ADDING

$hashedPassword = $_POST["hashedPassword"];

$pass = '$2y$10$.tFncswOZnJrdaUa2tL83eqyms8JA3myvmdaxQwRT6rGhOqC2scyy';


$PHPhashedPassword = password_hash($hashedPassword, PASSWORD_DEFAULT);
echo "PHPhashedPassword $PHPhashedPassword <br>";

$username = "root";


if(password_verify($hashedPassword,$pass)){
    echo "true";
}else{
    echo "false";
}

$sql = "INSERT INTO users (username,password)
        VALUES ('$username', '$PHPhashedPassword')";

$conn->query($sql)
*/
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
        header("Location: dashboard.php"); // Redirect to dashboard or any other secure page
    } else {
        // Invalid credentials, redirect back to login page with an error message
        header("Location: login.php?error=1");
    }
} else {
    // User not found
    header("Location: login.php?error=1");
}

$conn->close();
?>
