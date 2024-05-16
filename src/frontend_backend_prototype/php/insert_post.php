<?php
include("connect.php");
$conn = connect();



if(isset($_POST["sort"]))
    $sortText = false;
    switch($_POST["sort"]){
        case "hodnoceni":
            $sort = "hodnoceni DESC";
            break;
        case "date":
            $sort = "date DESC";
            break;
        case "abcd":
            $sort = "nazev";
            break;
        case "chod":
            $sort = "chod";
            break;
        case "textInput":
            $sortText = true;
            break;
        default:
            $sort = "imgID";
            break;

    }

    if($sortText){
        $searchPhrase = $_POST["searchPhrase"];
        $sql = "SELECT * FROM imgs WHERE nazev LIKE '%$searchPhrase%'";
    }
    else{
        $sql = "SELECT * FROM imgs
        ORDER BY ".$sort." ;";                     
        
    }

    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        echo '<div class="obed"> 
            <div id="rating">
                <p>'.$row["hodnoceni"].'/10</p>
            </div>
            <img draggable="false" src="uploads/'.$row["fileName"].'" alt="jídlo">
            <h2 id="nazev">'.$row["nazev"].'</h2>
            <button class="imgDeleteButton" value="'.$row["imgID"].'">&#215;</button>
            <p>'.date("d.m. Y", strtotime($row["date"])).' &emsp; Chod: '.$row["chod"].'</p>
        </div>';
        }

    

$conn->close();
?>
