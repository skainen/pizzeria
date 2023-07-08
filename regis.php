<?php
require('db.php');
session_start();
$products = $_SESSION['products'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Rekisteröinti</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="https://kit.fontawesome.com/f17e988409.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['email'])) {
        // removes backslashes
        $etunimi = stripslashes($_REQUEST['etunimi']);
        //escapes special characters in a string
        $etunimi = mysqli_real_escape_string($con, $etunimi);
        $sukunimi    = stripslashes($_REQUEST['sukunimi']);
        $sukunimi    = mysqli_real_escape_string($con, $sukunimi);
        $puhelin    = stripslashes($_REQUEST['puhelin']);
        $puhelin    = mysqli_real_escape_string($con, $puhelin);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $osoite    = stripslashes($_REQUEST['osoite']);
        $osoite  = mysqli_real_escape_string($con, $osoite);
       /* $create_datetime = date("Y-m-d H:i:s"); */
        $query    = "INSERT into `Kayttaja` (etunimi, sukunimi, puhelin, email, password, osoite)
                     VALUES ('$etunimi', '$sukunimi', '$puhelin', '$email', '$password', '$osoite')";   // '" . md5($password) . "'"
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo '<header class="header"> 
            <div class="etusivu">
                <a href="etusivu.php"><div id="etusivulle" class="fa-solid fa-house-chimney"></div></a>
        </div>
        
            <!-- Yläpalkin tekstit -->
                <a href="pizzeriat.php">Pizzeriat</a>
                <a href="tuotteet.php">Tuotteet</a>
                <a href="otayhteytta.php">Ota yhteyttä</a>
    
            <div class="icons">
                <a href="kassa.php"><div id="kassa" class="fa-solid fa-cart-shopping"></div></a>
                <a href="regis.php"><div id="regis" class="fa-solid fa-user"></div></a>
               </div>
        
        </header>
        
        <div class="logo">
        <img src="images/pizzaa.jpg" alt="">
        </div>
            
            <div class="form-box">
                  <h3>Rekisteröityminen onnistui!</h3><br/>
                  <h2><a href="login.php">Kirjaudu sisään</a></h2>
                  </div>';
        }
         else {
            echo '<header class="header"> 
            <div class="etusivu">
                <a href="etusivu.php"><div id="etusivulle" class="fa-solid fa-house-chimney"></div></a>
        </div>
        
            <!-- Yläpalkin tekstit -->
                <a href="pizzeriat.php">Pizzeriat</a>
                <a href="tuotteet.php">Tuotteet</a>
                <a href="otayhteytta.php">Ota yhteyttä</a>
                
        
            <div class="icons">
                <a href="kassa.php"><div id="kassa" class="fa-solid fa-cart-shopping"></div></a>
                <a href="regis.php"><div id="regis" class="fa-solid fa-user"></div></a>
               </div>
        
        </header>
        
        <div class="logo">
                <img src="images/pizzaa.jpg" alt="">
        </div>
            
            <div class="form-box">
                  <h3>Antamallasi sähköpostiosoitteella on jo käyttäjä</h3><br/>
                  <h2><a href="regis.php">Takaisin rekisteröitymiseen</a></h2>
                  </div>';
        }
    } else {
?>
  <?php
 include('header.php');
 ?>

<div class="logo">
        <img src="images/pizzaa.jpg" alt="">
</div>


<form class="form-box" action="" method="post">
        <h1 id="title">Rekisteröidy</h1>
        <div class="input group">
        <input type="text" class="input-field" name="etunimi" placeholder="Etunimi" required />
        <input type="text" class="input-field" name="sukunimi" placeholder="Sukunimi" required />
        <input type="text" class="input-field" name="puhelin" placeholder="Puhelin" required/>
        <input type="email" class="input-field" name="email" placeholder="Email" required>
        <input type="text" class="input-field" name="osoite" placeholder="Osoite" required>
        <input type="password" class="input-field" name="password" placeholder="Salasana" required>
        
  

    <div class="btnK">
        <button type="button" id="signinBtn">Kirjaudu sisään</button>
    </div>
    
    <div class="submit-btnR">
        <button type="submit" id="signupSubmit">Rekisteröidy</button>
    </div>

</form>
<?php
    } $con->close();
?>

<script>

let signinBtn = document.getElementById("signinBtn");

signinBtn.onclick = function(){
    location.href = "login.php";
}

  </script>

</body>
</html>