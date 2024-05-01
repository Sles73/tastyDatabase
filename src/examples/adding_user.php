<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    echo "fail";
die("Connection failed: " . $conn->connect_error);
}


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

?>