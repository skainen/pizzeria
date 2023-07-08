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
    <title>Etusivu</title>
<!-- Latest compiled and minified CSS -->
<!-- https://xstore.8theme.com/demos/hosting/-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<!-- Optional theme -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- JavaScript -->
<script src="slider.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,700&subset=latin-ext" rel="stylesheet">
<script src="https://kit.fontawesome.com/f17e988409.js" crossorigin="anonymous"></script>
  </head>
  <body>

  <?php
 include('header.php');
 ?>

<!--<div class="logo">
<img src="images/pizzaa.jpg" alt="">
</div>-->


<!-- Pizzeriat slider -->

<div class="slideshow-container">
  <div class="mySlides1">
    <a href="pizzeria1.php"><img src="images/espoo.jpg" style="width:100%">
  </div>

  <div class="mySlides1">
    <a href="pizzeria2.php"><img src="images/helsinki.jpg" style="width:100%">
  </div>

  <div class="mySlides1">
    <a href="pizzeria3.php"><img src="images/vantaa.jpg" style="width:100%">
  </div>

  <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
  <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
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



<!-- Tuotteet otsikko -->

       <div>
        <div class="container">
          <div class="row" id="slider-text">
            <div class="col-md-6">
              <h2>Pizzat ja Juomat</h2>
            </div>
          </div>
        </div>


        <!-- Tuotteet slider -->

        <!--SLIDER ALKAA-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="carousel carousel-showmanymoveone slide" id="itemslider">
            <div class="carousel-inner">
              <script>
                function generateProductDivs() {

                  <?php
                  $sql = "SELECT tuote, hinta, kuva, taytteet FROM `Tuotteet`";
                  $result = mysqli_query($con, $sql) or die(mysql_error());
                  $data = array();
                  if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                      $data[] = $row;
                    }

                  } else {
                    echo "0 results";
                  }
                  echo 'var data = ' . json_encode($data) . ';';
                  ?>


                  var productDiv = '';
                  // loop through the data to generate the divs

                  
                  for (let i = 0; i < data.length; i++)
                   {
                    const product = data[i];
                    productDiv += `
                      <div class="item ${i === 0 ? 'active' : ''}">
                        <div class="col-xs-12 col-sm-6 col-md-2">
                          <a href="tuotteet.php">
                            <img src="${product.kuva}" class="img-responsive center-block">
                          </a>
                          <h4 class="text-center">${product.tuote}</h4>
                          <h5 class="text-center">${product.taytteet}</h5>
                          <h4 class="text-center">${product.hinta}€</h4>
                        </div>
                      </div>
                    `;

                  }
                
                  $(".carousel-inner").append(productDiv);
                  $('.carousel').carousel();
                }


                // call the function after the page has loaded
                $(document).ready(function () {
                  generateProductDivs();
                });
              </script>

            </div>


            <div id="slider-control">
              <a class="left carousel-control" href="#itemslider" data-slide="prev"><img src="images/slide-left.png"
                  alt="Left" class="img-responsive"></a>
              <a class="right carousel-control" href="#itemslider" data-slide="next"><img src="images/slide-right.png"
                  alt="Right" class="img-responsive"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="slider.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
      integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
      crossorigin="anonymous"></script>
    <!--SLIDER LOPPUU-->


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



