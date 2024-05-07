<?php
include("connect.php");
$conn = connect();
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

// If logged in, welcome the user
echo "Welcome, " . $_SESSION['username'] . "!";
?>


<?php 
/*
        session_destroy();
        header("Location: login.html");
        exit;
    */
?>