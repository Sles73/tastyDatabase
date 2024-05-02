<?php
include("connect.php");
$conn = connect();
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// If logged in, welcome the user

?>

<?php 

if(isset($_POST["deleteUser"])){
    if(!empty($_POST["username"])){
        $username = $_SESSION['username'];
        $userID = $_POST["username"];
        echo "Delete $username with ID $userID";
    }
}else if(!empty($_POST["hashedPassword"]) && !empty($_POST["username"])){
    $username = $_SESSION['username'];
    $userID = $_POST["username"];
    $password = $_POST["hashedPassword"];
    echo "Changing $username with ID $userID password to $password";
}


?>