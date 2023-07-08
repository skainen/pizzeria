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
<form class="form-box" action="" method="post">
        <h1 id="title">Tilaus lähetetty!</h1>


    </form>
</body>
</html>