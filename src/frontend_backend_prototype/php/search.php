<?php
    include("connect.php");
    $conn = connect();

    // Získání hodnoty z vyhledávacího pole, pokud existuje
    if (isset($_POST['searchBar'])) {
        $search = $_POST['searchBar'];
        // SQL dotaz pro vyhledávání podle názvu
        $sql = "SELECT * FROM imgs WHERE nazev LIKE '%$search%'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // výpis dat z každého řádku
            echo "<hr><ul id=\"whisper\">";
            while($row = $result->fetch_assoc()) {
            echo "<li>" . $row["nazev"]. "</li>";
            }
            echo "</ul>";
        } else {
            echo "";
        }
    }
    if (isset($_POST['clear']))
    {
        $sql = "SELECT * FROM imgs WHERE nazev LIKE '%$search%'
                ORDER BY date;";
                $result = $conn->query($sql);
        
        while($row = $result->fetch_assoc()){

            echo "<div> 
                <h2>".$row["nazev"].'</h2>
                Dne: '.$row["date"].'<br>
                Hodnoceno: '.$row["hodnoceni"].'/10<br>
                Chod: '.$row["chod"].'<br>
                <img style="height: 50vh;" src="uploads/'.$row["fileName"].'" alt="'.$row["nazev"].'">
                </div>';
        }
    }
    $conn->close();
?>