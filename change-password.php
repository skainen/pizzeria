<?php
require('db.php');
session_start();
$products = $_SESSION['products'];
$email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Salasanan vaihto</title>
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
        <h1 id="title">Vaihda salasana</h1>
        <div class="input group">

        <input type="password" class="input-field" name="old" placeholder="Vanha salasana">
        <input type="password" class="input-field" name="new" placeholder="Uusi salasana">
        <input type="password" class="input-field" name="retype" placeholder="Uusi salasana uudestaan">
        </div>
        <div class="submit">
        <input type="submit" name="update" value="Lähetä" id="form_button" />
    </div>
   <!-- <input type="submit" name="update"> Update</button>-->



    </form>
<?php

  if(isset($_POST['update'])){


    $old = $_POST['old'];
  $new = $_POST['new'];
  $retype = $_POST['retype'];
  $email = $_SESSION['email'];

if(count($_POST)>0) {
$result = mysqli_query($con,"SELECT * FROM Kayttaja WHERE email='$email'");
$row=mysqli_fetch_array($result);

  if(($old == $row["password"]) && ($new == $retype)){

mysqli_query($con,"UPDATE Kayttaja SET password='$new' WHERE email='$email'");
echo "<script>alert('Salasana vaihdettu!'); window.location='profiili.php'</script>";


} else{
  echo "<script>alert('Virhe'); window.location='change-password.php'</script>";
}
}
  }

        ?> 




</body>
</html>