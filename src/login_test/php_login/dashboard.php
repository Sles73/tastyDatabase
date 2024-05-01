<?php
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// If logged in, welcome the user
echo "Welcome, " . $_SESSION['username'] . "!";
session_destroy();
?>

<form action="" method="post">
<button type="submit" name="logout">Log out</button>
</form>

<?php 
if(isset($_POST["logout"])){
    session_destroy();
    header("Location: login.php");
    exit;
}

?>


