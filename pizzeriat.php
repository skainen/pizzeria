<?php
require('db.php');
session_start();
$products = $_SESSION['products'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeriat</title>
    <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">

    <script src="https://kit.fontawesome.com/f17e988409.js" crossorigin="anonymous"></script>

  </head>
  <body>

  <?php
 include('header.php');
 ?>
<div class="logo">
<img src="" alt="">

</div>
</br>

<!-- Pizzeria slider -->

<div class="slideshow-container">
  <div class="mySlides1">
    <a href="pizzeria1.php"><img src="images/espoo.jpg" style="width:100%">
  </div>

  <div class="mySlides1">
    <a href="pizzeria3.php"><img src="images/helsinki.jpg" style="width:100%">
  </div>

  <div class="mySlides1">
    <a href="pizzeria2.php"><img src="images/vantaa.jpg" style="width:100%">
  </div>

  <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
  <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
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
	
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

	<script>
let slideIndex = [1,1];
let slideId = ["mySlides1", "mySlides2"]
showSlides(1, 0);
showSlides(1, 1);

function plusSlides(n, no) {
  showSlides(slideIndex[no] += n, no);
}

function showSlides(n, no) {
  let i;
  let x = document.getElementsByClassName(slideId[no]);
  if (n > x.length) {slideIndex[no] = 1}    
  if (n < 1) {slideIndex[no] = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex[no]-1].style.display = "block";  
}
</script>


    <?php
$con->close();



?>
  </body>
</html>