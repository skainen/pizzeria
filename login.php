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
    // When form submitted, check and create user session.
    if (isset($_POST['email'])) {
        // removes backslashes
        $email= stripslashes($_REQUEST['email']);    // removes backslashes
        $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `Kayttaja` WHERE email='$email'
                     AND password='$password'";   // '" . md5($password) . "'"
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
          $_SESSION['email'] = $email;
          $_SESSION['etunimi'] = $etunimi;
          $_SESSION['sukunimi'] = $sukunimi;
          $_SESSION['puhelin'] = $puhelin;
          $_SESSION['osoite'] = $osoite;
          $_SESSION['kayttajaID'] = $kayttajaID;
    
          header("Location: etusivu.php");

        }
        else{
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
                <h3>Väärä sähköpostiosoite tai salasana.</h3><br/>
                <h2><a href="regis.php">Takaisin rekisteröitymiseen</a></h2>
                </div>';
        }
    } else {

      include('header.php');
?>
 


<div class="logo">
<img src="images/pizzaa.jpg" alt="">
</div>



    <form class="form-box" action="" method="post">
        <h1 id="title">Kirjaudu</h1>
        <div class="input group">
        <input type="email" class="input-field" name="email" placeholder="Email" required>
        <input type="password" class="input-field" name="password" placeholder="Salasana" required>
  
        <!-- Napit jotka "vaihtaa" formia -->
      <div class="btnR">
        <button type="button" id="signupBtn">Rekisteröidy</button>
        </div>

      <div class="btnK">
        <button type="button" id="signinBtn">Kirjaudu sisään</button>
           </div>
            
            <div class="submit-btnK">
            <button type="submit" id="signinSubmit">Kirjaudu Sisään</button>
</div>
    </div>
    </form>
<?php
    }
?>

<script>

let signupBtn = document.getElementById("signupBtn");

signupBtn.onclick = function(){
    location.href = "regis.php";
}

  </script>

</body>
</html>
