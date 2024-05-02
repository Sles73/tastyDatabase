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

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload Form</title>
    <link rel="stylesheet" href="dashboardTemporary.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <script src="hash.js"></script>
</head>
<body>

    <form action="" method="post">
        <h2><?php echo "Welcome, " . $_SESSION['username'] . "!";?></h2>
        <button type="submit" name="logout">Log out</button>
    </form>

    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="date">Select Date:</label>
            <input type="date" id="date" name="date">
        </div>
        <div>
            <label for="course">Select the course</label>
            <select id="course" name="course">
                <option value="1">Course 1</option>
                <option value="2">Course 2</option>
                <option value="3">Course 3</option>
            </select>
        </div>
        <div>
            <label for="slider">Select a number from 1 to 10:</label>
            <input type="range" id="slider" name="slider" min="1" max="10" step="1">
        </div>
        <div style="margin-top: 20px;">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <div style="margin-top: 20px;">
            <input type="submit" value="Upload Image" name="submit">
        </div>
    </form>

    <form onsubmit="handleSubmitForUserAdd(event)" method="post" action="addUser.php">
        <h3>Přidání uživatele</h3>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="passwordAgain" name="passwordAgain" required><br><br>
        <p id="warning"></p>
        <button type="submit" name="addUser">Submit</button>
    </form>

    <form onsubmit="handleSubmitForUserModify(event)" method="post" action="modifyUser.php" id="modifyUser">
        <h3>user management</h3>
        <label for="username">Username:</label><br>
        <select type="text" id="username" name="username" required>
            <?php 
                      $sql = "SELECT * FROM users";                           
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {                          
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row["userID"].'">'.$row["username"].'</option>';
                      }
                      } else {
                      echo "0 results";
                      }
                  ?>
        </select>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" ><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="passwordAgain" name="passwordAgain" ><br><br>
        <p id="text"></p>
        <button type="submit" name="changePassword">changePassword</button>
        <button type="submit" id="delete" style="background-color: #ff3030;" name="deleteUser">deleteUser</button>
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

<!-- Adding images to database -->
<?php
    $targetDirectory = "uploads/"; // Directory where uploaded files will be stored
    // Check if file is uploaded successfully
    if(isset($_FILES["fileToUpload"]["tmp_name"]) && !empty($_FILES["fileToUpload"]["tmp_name"]) && !empty($_POST["date"]) && !empty($_POST["slider"]) && !empty($_POST["course"]) && !empty($_POST["name"])) {
        $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]); // Path to the uploaded file

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            // Proceed with file upload
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                $name = $_POST["name"];
                $fileName = basename( $_FILES["fileToUpload"]["name"]);
                $date = $_POST["date"];
                $hodnoceni = $_POST["slider"];
                $course = $_POST["course"];

                $sql = "INSERT INTO imgs (nazev,filename,date,hodnoceni,chod)
                VALUES ('$name', '$fileName', '$date','$hodnoceni','$course')";
                $conn->query($sql);

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


<!-- Log Out form -->
<?php 
    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: login.php");
        exit;
    }
?>


