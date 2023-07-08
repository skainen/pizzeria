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
        <h1 id="title">Vaihda osoite</h1>
        <div class="input group">

        <input type="text" class="input-field" name="new" placeholder="Uusi osoite">
 
        </div>
        <div class="submit">
        <input type="submit" name="update" value="Lähetä" id="form_button" />
    </div>
</form>


<?php

  if(isset($_POST['update'])){

  $new = $_POST['new'];

if(count($_POST)>0) {
$result = mysqli_query($con,"SELECT * FROM Kayttaja WHERE email='$email'");
$row=mysqli_fetch_array($result);

    if($new){
mysqli_query($con,"UPDATE Kayttaja SET osoite='$new' WHERE email='$email'");
echo "<script>alert('Osoite vaihdettu!'); window.location='profiili.php'</script>";


} else{
  echo "<script>alert('Virhe'); window.location='update-osoite.php'</script>";
}
}
  }

        ?> 
</body>
</html>