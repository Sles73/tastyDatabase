<?php
include("connect.php");
$conn = connect();
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    $data = array('login' => false);
    
}else{
    $data = array('login' => true);
    $username = $_SESSION['username'];
    // If logged in, welcome the user
    $data = array_merge($data, array('username' => $username));
}

if(isset($_POST["checkLogin"])){
    $dataJson = json_encode($data);
    // Send JSON response back to the client
    header('Content-Type: application/json');
    echo $dataJson;
}

?>


<?php 
/*
        session_destroy();
        header("Location: login.html");
        exit;
    */
?>