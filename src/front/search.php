<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "users";

    // Vytvoření připojení
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kontrola připojení
    if ($conn->connect_error) {
        die("Připojení selhalo: " . $conn->connect_error);
    }

    // Získání hodnoty z vyhledávacího pole, pokud existuje
    if (isset($_POST['searchBar'])) {
        $search = $_POST['searchBar'];
        // SQL dotaz pro vyhledávání podle názvu
        $sql = "SELECT * FROM imgs WHERE nazev LIKE '%$search%'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // výpis dat z každého řádku
            echo "<ul id=\"whisper\">";
            while($row = $result->fetch_assoc()) {
            echo "<li>" . $row["nazev"]. "</li>";
            }
            echo "</ul>";
        } else {
            echo "0 výsledků";
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