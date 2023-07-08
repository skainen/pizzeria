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
    <h1 id="title"><?php echo "Tilaukset";?></h1>


    <?php

    $sql = "SELECT * FROM tilaukset WHERE asiakasID = '$kayttajaID'";
    $result = $con->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<table><tr><td>"
            
            . $row["tilauspvm"]. "</br>"
            . $row["tuotteet"]. "</br></td></table><table><td>"
            . $row["hinta"]. "</td></tr></table>
           
            </table>";

        
        }
    } else {
        echo "0 results";
    }
?>

<h1 id="title"><?php echo "</br><a href='profiili.php'>Profiili</a>"?></h1>
</div>
    </form>
<?php
    $con->close();
?>


  </script>

</body>
</html>