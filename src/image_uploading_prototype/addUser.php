<?php 
include("connect.php");
$conn = connect();
session_start();
?>

<?php 


    if(!empty($_POST["hashedPassword"]) && !empty($_POST["username"])) {
        
        $username = $_POST['username'];
        $password = $_POST['hashedPassword'];
        $hashedPassword = $_POST["hashedPassword"];

        $PHPhashedPassword = password_hash($hashedPassword, PASSWORD_DEFAULT);
 
        $sql = "INSERT INTO users (username,password)
                VALUES ('$username', '$PHPhashedPassword')";

        $conn->query($sql);
        header("Location: dashboard.php");
    }
$conn->close();
?>