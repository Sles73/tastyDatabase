<?php

function connect($dbname = "users"){
    $servername = "localhost";
    $username = "root";
    $password = "";
        // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        echo "fail";
    die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
