<?php
require('db.php');
session_start();
$products = $_SESSION['products'];
$email = $_SESSION["email"];
$kayttajaID = $_SESSION["kayttajaID"];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Profiili</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="https://kit.fontawesome.com/f17e988409.js" crossorigin="anonymous"></script>
</head>
<body>

<?php
 include('header.php');
 ?>

<div class="logo">
<img src="images/pizzaa.jpg" alt="">
</div>


    <form class="form-prof" action="" method="post">
    <h1 id="title"><?php echo "Profiili";?></h1>


    <?php

    $sql = "SELECT * FROM Kayttaja WHERE email = '$email'";
    $result = $con->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<table><tr><td class='oikea'>
            
          
            <a href='update-nimi.php'>Muokkaa</a></td></br><td>"
            . $row["etunimi"]. "</br>"
            . $row["sukunimi"]. "</br></td></table><table><td class='oikea'>
            <a href='update-puh.php'>Muokkaa</a></td></br><td>"
            . $row["puhelin"]. "</td></table><table><td class='oikea'>
            <a href='update-osoite.php'>Muokkaa</a></td></br><td>"             
            . $row["osoite"]. "</td></table><table><td class='oikea'>
            <a href='update-email.php'>Muokkaa</a></td></br><td>"
            . $row["email"]. "</br></td>
            
            </tr></table>";

        
        }
    } else {
        echo "0 results";
    }
?>

<h2 id="title"><?php echo "</br><a href='tilaukset.php'>Tilaukset</a>"?></h2>
<h2 id="title"><?php echo "</br><a href='change-password.php'>Vaihda salasana</a>"?></h2>
</form>

<?php
      
       $con->close();
       ?>
    


</body>
</html>