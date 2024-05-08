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
                    echo "No file uploaded or file upload failed or not all data given.";
                }
        }
        
    }


    
    
}


    
    

?>


<?php 
function logOut(){
        session_destroy();
        header("Location: login.html");
        exit;
}

function sendJson($data){
    // Convert the array to JSON format
    $jsonString = json_encode($data, JSON_PRETTY_PRINT);
    header('Content-Type: application/json');
    // Output the JSON string
    echo $jsonString;
}

?>