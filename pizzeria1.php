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
    <title>Pizzeria1</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/f17e988409.js" crossorigin="anonymous"></script>
</head>
<body>

<?php
 include('header.php');
 ?>

<div class="logo">
<img src="images/pizzaa.jpg" alt="">
</div>


<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

  <!-- About Section -->
  <div class="w3-row w3-padding-64" id="about">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
     <img src="images/pizzakuva1espoo.png" class="w3-round w3-image w3-opacity-min" alt="Tähän joku pizzerian kuva" width="600" height="750">
    </div>

    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">Pizza Espoo</h1><br>
      <h5 class="w3-center">Tervetuloa</h5>
      <p class="w3-large">Täällä tehdään pizzoja. Ollaan tehty pizzoja pitkään itse.</p>
      <p class="w3-large w3-text-grey w3-hide-medium">Sijaitsemme Teirintie 1, 02770 Espoo. Avoinna joka päivä 9:00-22:00. Puh 045 232 2575</p>
    </div>
  </div>
  
  <hr>
  
  <!-- Siirtyy tuotteisiin -->
  <div class="w3-row w3-padding-64" id="menu">
    <div class="w3-col l6 w3-padding-large">
      <h1 class="w3-center"><a href="tuotteet.php">Täällä tuotteet</a></h1><br>
 
    </div>
    
    <div class="w3-col l6 w3-padding-large">
      <img src="pizzakuva1espoo.png" class="w3-round w3-image w3-opacity-min" alt="" style="width:100%">
    </div>
  </div>

  <hr>


<!-- End page content -->
</div>

     <!-- Footer -->

     <div class="footer-clean">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Yritystiedot</h3>
                        <ul>
                            <li><a href="#">Y-Tunnus 4242442</a></li>
                            <li><a href="#">Kuopiokatu 6 70100</a></li>
                            <li><a href="#">+358 44 123 1444</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Linkit</h3>
                        <ul>
                            <li><a href="pizzeriat.php">Pizzeriat</a></li>
                            <li><a href="tuotteet.php">Tuotteet</a></li>
                            <li><a href="otayhteytta.php">Ota yhteyttä</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Lisätiedot</h3>
                        <ul>
                            <li><a href="#">Avoinna ma-su 9:00 - 22:00</a></li>
                          
                        </ul>
                    </div>
                    <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                        <p class="copyright">Pizzakuopio © 2023</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>



</body>
</html>