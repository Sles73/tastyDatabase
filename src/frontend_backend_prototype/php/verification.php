<?php 
include("connect.php");
$conn = connect();
session_start();
?>


<?php

if(!empty($_POST['username']) && !empty($_POST['hashedPassword'])){
    $username = $_POST['username'];
    $password = $_POST['hashedPassword'];


    $stmt = $conn->query("SELECT password, userID FROM users WHERE username = '$username'");
    $user = $stmt->fetch_assoc();

    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password'])) {
                // Valid credentials, start session and redirect
            $_SESSION['username'] = $username;
            $_SESSION['userID'] = $user["userID"];
            $data["username"] = $username;
            $data = array('login' => true); // Redirect to dashboard or any other secure page
        } else {
            // Invalid credentials, redirect back to login page with an error message
            $data = array('login' => false);
        }
    } else {
        // User not found
        $data = array('login' => false);
    }
    $dataJson = json_encode($data);
    header('Content-Type: application/json');
    echo $dataJson;
}

if(isset($_POST["checkLogin"])){
    if (!isset($_SESSION['username'])) {
        $data = array('login' => false);
    }else{
        $data = array('login' => true);
        $username = $_SESSION['username'];
        $data["username"] = $username;
    }
    // Convert data to JSON format
    $dataJson = json_encode($data);

    // Send JSON response back to the client
    header('Content-Type: application/json');
    echo $dataJson;
}





$conn->close();
?>
