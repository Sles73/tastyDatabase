<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="login.php">login</a>

    <?php 
        include("connect.php");
        $conn = connect();

        $sql = "SELECT * FROM imgs
                ORDER BY date;";                            //zástupný znak pro všechny
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
    
    ?>

</body>
</html>