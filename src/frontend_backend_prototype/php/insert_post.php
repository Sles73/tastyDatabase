<?php
// Simulate database connection and insertion
// Replace this with your actual database connection and insertion code
include("connect.php");
$conn = connect();

// Assuming you're using PDO for database operations

$sql = "SELECT * FROM imgs
            ORDER BY date;";                            //zástupný znak pro všechny
            $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){

        /*echo "<div class=\"obed\"> 
            <h2>".$row["nazev"].'</h2>
            Dne: '.$row["date"].'<br>
            Hodnoceno: '.$row["hodnoceni"].'/10<br>
            Chod: '.$row["chod"].'<br>
            <img style="height: 50vh;" src="uploads/'.$row["fileName"].'" alt="'.$row["nazev"].'">
            </div>';*/
        echo '<div class="obed"> 
            <div id="rating">
                <p>'.$row["hodnoceni"].'/10</p>
            </div>
            <img draggable="false" src="uploads/'.$row["fileName"].'" alt="jídlo">
            <h2>'.$row["nazev"].'</h2>
            <p>'.date("d.m. Y", strtotime($row["date"])).' &emsp; Chod: '.$row["chod"].'</p>
        </div>';
        

        }
    

$conn->close();
?>
