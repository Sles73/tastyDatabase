<?php 
include("connect.php");
?>

<?php
/*
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
        // Password is correct
        echo "Login successful!";
    } else {
        // Password is incorrect
        echo "Invalid username or password";
    }
} else {
    // User not found
    echo "Invalid username or password";
}

?>
