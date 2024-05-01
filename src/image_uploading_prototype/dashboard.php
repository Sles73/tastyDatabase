<?php
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// If logged in, welcome the user

?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            margin: 20px auto;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }

        input[type="date"] {
            margin-bottom: 10px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <form action="" method="post">
    <h2><?php echo "Welcome, " . $_SESSION['username'] . "!";?></h2>
    <button type="submit" name="logout">Log out</button>
    </form>

    <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="date" id="date" name="date">
        <input type="submit" value="Upload Image" name="submit">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get today's date
            var today = new Date().toISOString().split('T')[0];

            // Set the input value to today's date
            document.getElementById("date").value = today;
        });
    </script>
</body>
</html>

<?php
$targetDirectory = "uploads/"; // Directory where uploaded files will be stored

// Check if file is uploaded successfully
if(isset($_FILES["fileToUpload"]["tmp_name"]) && !empty($_FILES["fileToUpload"]["tmp_name"])) {
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]); // Path to the uploaded file

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        // Proceed with file upload
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
} else {
    echo "No file uploaded or file upload failed.";
}
?>


<?php 
if(isset($_POST["logout"])){
    session_destroy();
    header("Location: login.php");
    exit;
}

?>


