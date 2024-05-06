<?php
include("connect.php");
$conn = connect();



if(isset($_POST["sort"]))
    switch($_POST["sort"]){
        case "hodnoceni":
            $sort = "hodnoceni DESC";
            break;
        default:
            $sort = "imgID";
            break;

    }

    $sql = "SELECT * FROM imgs
    ORDER BY ".$sort." ;";                     
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){
        echo '<div class="obed"> 
            <div id="rating">
                <p>'.$row["hodnoceni"].'/10</p>
            </div>
            <img draggable="false" src="uploads/'.$row["fileName"].'" alt="jídlo">
            <h2 id="nazev">'.$row["nazev"].'</h2>
            <p>'.date("d.m. Y", strtotime($row["date"])).' &emsp; Chod: '.$row["chod"].'</p>
        </div>';
        }


    

$conn->close();
?>
