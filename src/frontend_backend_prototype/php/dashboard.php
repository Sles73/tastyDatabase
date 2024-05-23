<?php
include("connect.php");
$conn = connect();
session_start();

$data = array();
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    $data['login'] = false;
    sendJson($data);
    
}else{
    if(isset($_POST["type"])){
        switch($_POST["type"]){

            case "checkLogin":
                $data['login'] = true;
                $username = $_SESSION['username'];
                // If logged in, welcome the user
                $data['username'] = $username;
                sendJson($data);
                break;

            case "logOut":
                session_destroy();
                $data['response_type'] = 'log_out';
                $data['redirect'] = 'about.html';
                sendJson($data);
                break;

            case "imgForm":
                $targetDirectory = "../uploads/"; // Directory where uploaded files will be stored
                // Check if file is uploaded successfully
                if(isset($_FILES["fileToUpload"]["tmp_name"]) && !empty($_FILES["fileToUpload"]["tmp_name"])  && !empty($_FILES["fileToUpload"]["tmp_name"]) && !empty($_POST["date"]) && !empty($_POST["slider"]) && !empty($_POST["course"]) && !empty($_POST["name"])) {
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
                            $addedBy = $_SESSION["userID"];
                            $sql = "INSERT INTO imgs (nazev,addedBy,filename,date,hodnoceni,chod)
                            VALUES ('$name', '$addedBy', '$fileName', '$date','$hodnoceni','$course')";
                            $conn->query($sql);
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    } else {
                        echo "File is not an image.";
                    }
                } else {
                    echo "No file uploaded or file upload failed or not all data given.";
                }
                break;
                
            case "addUser":
                if(!empty($_POST["hashedPassword"]) && !empty($_POST["username"])) {
                    $username = $_POST['username'];

                    $stmt = $conn->query("SELECT password, userID FROM users WHERE username = '$username'");
                    $user = $stmt->fetch_assoc();

                    if ($user) {
                        echo "user already exists";
                    } else {
                        
                        $hashedPassword = $_POST["hashedPassword"];
                
                        $PHPhashedPassword = password_hash($hashedPassword, PASSWORD_DEFAULT);
                
                        $sql = "INSERT INTO users (username,password)
                                VALUES ('$username', '$PHPhashedPassword')";
                
                        $conn->query($sql);
                        
                        echo "user added";
                    }
                }else{
                    echo "informations not given";
                }
                break;

            case "loadUser":
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
                break;
            
            case "deleteUser":
                $username = $_POST["username"];
                $sql = "DELETE FROM users WHERE userID = $username;";
                $conn->query($sql);
                echo "user deleted";
                break;

            case "deleteImg":
                $imgId = $_POST["imgID"];
                $sql = "SELECT fileName FROM imgs WHERE imgID = $imgId";
                $result = $conn->query($sql)->fetch_assoc()["fileName"];
                $result = "../uploads/$result";
                echo $result;
                unlink($result);
                $sql = "DELETE FROM imgs WHERE imgID = $imgId;";
                $conn->query($sql);
                echo "php response:\nimg $imgId deleted";
                break;

            case "passwordChange":
                if (!empty($_POST["hashedPassword"])) {
                    $userId = $_SESSION["userID"];
                    $hashedPassword = $_POST["hashedPassword"];
                    
                    // Hash the password using PHP's password_hash function
                    $PHPhashedPassword = password_hash($hashedPassword, PASSWORD_DEFAULT);

                    // Prepare the SQL statement
                    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE userID = ?");
                    
                   // Bind parameters
                    $stmt->bind_param("si", $PHPhashedPassword, $userId);

                    // Execute the query
                    if ($stmt->execute()) {
                        echo "Password changed";
                    } else {
                        echo "Error updating password: " . $stmt->error;
                    }

                    // Close the statement
                    $stmt->close();
                } else {
                    echo "Information not given";
                }
                break;

                
        }
        
    }


    
    
}


    
    
$conn->close();
?>


<?php 
function sendJson($data){
    // Convert the array to JSON format
    $jsonString = json_encode($data, JSON_PRETTY_PRINT);
    header('Content-Type: application/json');
    // Output the JSON string
    echo $jsonString;
}

?>