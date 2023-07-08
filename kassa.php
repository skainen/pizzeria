<?php
require('db.php');
session_start();
$_SESSION['kayttajaID'] = $kayttajaID;

if (isset($_POST['products'])) {
  $_SESSION['products'] = json_decode($_POST['products'], true);
}

$products = $_SESSION['products'];

?>

<script>
  var products = <?php echo json_encode($products); ?>;
  console.log(products);
</script>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kassa</title>
  <link rel="stylesheet" href="style.css">
  <script src="hideshow.js"></script>
  <script src="https://kit.fontawesome.com/f17e988409.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<header class="header">
    <div class="etusivu">
      <a href="etusivu.php">
        <div id="etusivulle" class="fa-solid fa-house-chimney"></div>
      </a>
    </div>
    <a href="pizzeriat.php">Pizzeriat</a>
    <a href="tuotteet.php">Tuotteet</a>
    <a href="otayhteytta.php">Ota yhteyttä</a>

    <div class="icons">
      <a href="kassa.php">
        <div id="kassa" class="fa-solid fa-cart-shopping"></div>
      </a>
      <?php
      //Käyttäjäikoni vie rekisteröinti sivulle käyttäjä ei ole
      // kirjautunut sisään, ja profiili sivulle jos on.
      
      if (isset($_SESSION["email"])) {
        echo "<a href='profiili.php'><div id='profiili' class='fa-solid fa-user'></div></a>";
      } else {
        echo "<a href='regis.php'><div id='regis' class='fa-solid fa-user'></div></a>";
      }

      // Logout nappi jos kirjauduttu sisään.
      
      if (isset($_SESSION["email"])) {
        echo "<a href = 'logout.php'><div id='logout' class='fa-solid fa-right-from-bracket'></div></a>";
      }
      ?>
    </div>
  </header>


  <form class="form-kassa" action="./tilausvahvistus1.php" method="post">
  <div class="logo">
    <img src="images/pizzaa.jpg" alt="">
  </div>



<!-- Sivun koodi alkaa -->
   
  <div class="row">
    <div class="col-75">
      <div class="kassacontainer">
        <div class="row">
          <div class="col-25">
            <div class="kassacontainer" id="checkout">
              <h1 id="title"></br>Ostoskori <span class="price" style="color:#544a40;"><i class="fa-solid fa-cart-shopping"></i>
                </span></h1>
              <br>
              <script>
                $(document).ready(function () {
                  var totalPrice = 0;
                  var productCounter = 0;
                  for (var i = 0; i < products.length; i++) {
                    var product = products[i];
                    var productName = product.Nimi;
                    var productPrice = product.Hinta;
                    var productAdd = product.Add;
                    var productAmount = product.Maara;

                    productCounter += 1;

                    var productPriceFull = parseFloat(productPrice.replace('€', ''));
                    productPriceFull = productPriceFull * productAmount;

                    $("#tuote").css("margin-block", "5px");

                    var addItemsString = "";
                    if (productAdd) {
                      var addItems = productAdd.split(", ");
                      for (var j = 0; j < addItems.length; j++) {
                        var addItem = addItems[j];
                        productPriceFull += 1; // FIX THIS

                        addItemsString += addItem + " +1€, ";
                      }
                    }
                    addItemsString = addItemsString.slice(0, -2);
                    var addItemElement = $('<span style="color: #544a40; padding-inline: 15vw;">' + addItemsString + '</span>'); //MAKE THEM ALIGNED
                    var addAmount = $('<span style="color: #544a40; padding-inline: 15vw;">x' + productAmount + '</span>');

                    var productElement = $('<p>' + productName + ' <span class="price">' + productPriceFull.toFixed(2) + '€</span></p>');
                    productElement.append(addItemElement);
                    productElement.append(addAmount);

                    $('#checkout').append(productElement);

                    totalPrice += productPriceFull;
                  }

                  $('#productcounter').append(productCounter);

                  var totalPriceElement = $('<br><hr><br><p>Yhteensä: <span class="price" style="color:#544a40;"><b>' + totalPrice.toFixed(2) + '€</b></span></p>');
                  $('#checkout').append(totalPriceElement);
                });
              </script>
            </div>
          </div>
        </div>

        <div class="center">
          <div style="display: flex; align-items: center;">
            <h2 style="margin: 0;">Kotiinkuljetus</h2>
            <label class="switch">
              <input type="checkbox" id="deliverySwitch">
              <span class="slider round"></span>
            </label>
            <h2 style="margin: 0;">Nouto pizzeriasta</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-50">
            <h2>Nimi- ja Osoitetiedot</h2><br>
             
            <?php

if(isset($_SESSION["email"])){

   $email = $_SESSION ["email"];

$sql = "SELECT * FROM Kayttaja WHERE email = '$email'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
         $kayttajaID = $row['kayttajaID'];
         echo '<input type="hidden" name="products" value="' . htmlentities(serialize($products)) . '">';

        echo '<input type="hidden" name="kayttajaID" value="'.$kayttajaID.'">';

      echo '<label for="fname"></br></br><i class="fa fa-user"></i> Nimi:</label>
  <input type="text" id="fname" name="etunimi" value="'.$row['etunimi'].'">';

 echo  '<label for="lname"><i class="fa fa-user"></i> Sukunimi:</label>
  <input type="text" id="lname" name="sukunimi" value="'.$row['sukunimi'].'">';

  echo '<label for="phone"><i class="fa fa-phone"></i> Puhelinnumero:</label>
  <input type="text" id="phone" name="puhelin" value="'.$row['puhelin'].'">';

 echo '<label for="email"><i class="fa fa-envelope"></i> Sähköposti:</label>
  <input type="text" id="email" name="email" value="'.$row['email'].'">';

 echo '<label for="address" id="addressLabel"><i class="fa fa-address-card-o"></i> Toimitusosoite:</label>
  <input type="text" id="address" name="toimitusosoite" placeholder="Toimitusosoite">';

  echo '<div class="message"><label for="message"> Lisätietoja tilauksesta:</label>
  <textarea name="lisatiedot" id="message_input" cols="30" rows="5" placeholder="Kirjoita tähän"></textarea>';
    }

  }
}
 else {
    
  echo '<label for="fname"><i class="fa fa-user"></i> Nimi:</label>
  <input type="text" id="fname" name="etunimi" placeholder="Nimi">';

  echo '<label for="lname"><i class="fa fa-user"></i> Sukunimi:</label>
  <input type="text" id="lname" name="sukunimi" placeholder="Sukunimi">';

  echo '<label for="phone"><i class="fa fa-phone"></i> Puhelinnumero:</label>
  <input type="text" id="phone" name="puhelin" placeholder="Puhelinnumero">';

  echo '<label for="email"><i class="fa fa-envelope"></i> Sähköposti:</label>
  <input type="text" id="email" name="email" placeholder="Sähköposti">';

  echo '<label for="address" id="addressLabel"><i class="fa fa-address-card-o"></i> Toimitusosoite:</label>
  <input type="text" id="address" name="toimitusosoite" placeholder="Toimitusosoite">';

  echo '<div class="message"><label for="message"> Lisätietoja tilauksesta:</label>
  <textarea name="lisatiedot" id="message_input" cols="30" rows="5" placeholder="Kirjoita tähän"></textarea>';

 }


 


?>



<div class="center">
  <div class="col-50">
  <h2>Maksutapa</h2>
  <br><br>
    <div class="icon-container">
    <!--<button type="button" onclick="toggleCardinfo()"><i class="fa-regular fa-credit-card"><p>Visa/Mastercard</p></i></button>-->
    <label class="container"><i class="fa-solid fa-building-columns"><p>Pankki</p></i>
    <input type="radio" name="radio" id="clearRadio">
    <!--<span class="checkmark"></span>-->
  </label>
  <label class="container"><i class="fa-solid fa-money-bill-1-wave"><p>Käteinen</p></i>
    <input type="radio" name="radio" id="clearRadio">
    <!--<span class="checkmark"></span>-->
  </label>
  <!--<button onclick="clearRadioButtons()">Tyhjennä valinta</button>-->

<script>
  function clearRadioButtons() {
    var ele = document.querySelectorAll("input[type=radio]")
    for(var i=0;i<ele.length;i++) {
      ele[i].checked=false;
    }
  }
</script>
    </div>
  </div>
</div>
  <script>	
    function pankkiCheck() {	
      var checkBox = document.getElementById("pankkiCheck");	
      var text = document.getElementById("text");	
      if (checkBox.checked == true){	
        text.style.display = "block";	
      } else {	
        text.style.display = "none";	
      }	
    }	
  </script>	
    <script>	
    function cashCheck() {	
      var checkBox = document.getElementById("cashCheck");	
      var text = document.getElementById("text2");	
      if (checkBox.checked == true){	
        text.style.display = "block";	
      } else {	
        text.style.display = "none";	
      }	
    }	
  </script>	
             
            <div id="hideshow" style="display: none;">
    <label for="cname">Kortin haltijan nimi</label>
    <input type="text" id="cname" name="cardname" placeholder="Kortin haltijan nimi">
    <label for="ccnum">Kortin tiedot</label>
    <input type="text" id="ccnum" name="ccnum" placeholder="Kortin tiedot">
<div class="row">
  <div class="col-50">
    <label for="expyear">KK/VV</label>
    <input type="text" id="expyear" name="expyear" placeholder="00/00">
  </div>
    <div class="col-50">
      <label for="cvv">CVV</label>
      <input type="text" id="cvv" name="cvv" placeholder="123">
     </div>
</div>
          </div>
        </div>
      </div>
    </div>


  

  <script>
    function init() {
      const checkbox = document.querySelector(".switch input[type=checkbox]");
      const address = document.querySelector("#address");
      const addressLabel = document.querySelector("#addressLabel");

      checkbox.addEventListener("change", function () {
        if (checkbox.checked) {
          address.style.display = "none";
          addressLabel.style.display = "none";
        } else {
          address.style.display = "block";
          addressLabel.style.display = "block";
        }
      });
    }
    document.addEventListener("DOMContentLoaded", init);
  </script>


    <!-- <div class="submit">
        <input type="submit" name="tilaa" value="Tee tilaus" id="form_button" />
    </div>-->


    <button type="submit" name="submit">Tilaa</button>

  <?php
  $con->close();
  ?>

  </form>

</body>

</html>