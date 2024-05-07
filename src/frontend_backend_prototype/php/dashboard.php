<?php
include("connect.php");
$conn = connect();
session_start();

$data = array();
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    $data['login'] = false;
    
}else{
    $data['login'] = true;
    $username = $_SESSION['username'];
    // If logged in, welcome the user
    $data['username'] = $username;
    if(isset($_POST["type"])){
        switch($_POST["type"]){
            case "logOut":
                session_destroy();
                $data['response_type'] = 'log_out';
                $data['redirect'] = 'login.html';
                break;
        }
    }
}


    // Convert the array to JSON format
    $jsonString = json_encode($data, JSON_PRETTY_PRINT);
    header('Content-Type: application/json');
    // Output the JSON string
    echo $jsonString;
    

?>


<?php 
function logOut(){
        session_destroy();
        header("Location: login.html");
        exit;
}

?>