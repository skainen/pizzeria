<?php
require('db.php');
session_start();
//$email = $_SESSION["email"];??
$products = $_SESSION['products'];
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tuotteet</title>
  <link rel="stylesheet" href="style.css">
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
        <div id="kassa" class="fa-solid fa-cart-shopping" style="position: relative;"><span	
            class="product-count"></span></div>	
      <form id="productForm" style="display: none;" action="kassa.php" method="post">	
        <input type="hidden" id="products" name="products">	
      </form>	
      <script> // EDITOITU	
        $(document).ready(function () {	
          var products = <?php echo json_encode($products); ?>;	
          document.getElementById("products").value = JSON.stringify(products);	
          $("div#kassa").click(function () {	
            $("#productForm").submit();	
          });	
        });	
      </script>	
      <?php	
      if (isset($_SESSION["email"])) {	
        echo "<a href='profiili.php'><div id='profiili' class='fa-solid fa-user'></div></a>";	
      } else {	
        echo "<a href='regis.php'><div id='regis' class='fa-solid fa-user'></div></a>";	
      }	
      // Logout nappi jos kirjauduttu sisään.	
      	
      if (isset($_SESSION["email"])) {	
        echo "<a href = 'logout.php'><div id='logout' class='fa-solid fa-right-from-bracket'></div></a>";	
      } else {	
      }	
      ?>	
    </div>	
</header>


  <div class=" logo">
    <img src="images/pizzaa.jpg" alt="">
  </div>

  <!-- viesti-ikkuna (tuote lisätty/tuote poistettu) -->
  <div id="message" class="message" style="opacity: 0;"></div>
  <!-- "lisää täytteet" toiminto, tulee näkyviin kun käyttäjä lisää ostoskoriin jonkun tuotteen  -->
  <div id="lisataytteet" style="opacity: 0;">
    <a id="closebutton" href="#" style="float: right; font-weight: bolder; color: black;">&times;</a> <!-- close -->
    <h2 id="pizzaid" style="display: none;"></h2>
    <h2 id="pizzamaara"></h2>
    <h2 id="pizzanimi"></h2>
    <h2 id="pizzahinta"></h2><br>
    <h3 style="text-align: left;">Lisää:</h3><br>
    <div id="taycombox" style="text-align: left; display: table-caption;"> <!-- checkboxit lisätäytteet -->
      <div class="form-group" style="display: inline-flex">
        <input type="checkbox" name="juusto" id="juus" style="cursor: pointer !important;" /><label for="juus"
          style="padding-inline: 10px; cursor: pointer !important;">Juusto</label>
        <p style="font-weight: bolder; flex: none;">+
          1€</p>
      </div>
      <div class="form-group" style="display: inline-flex">
        <input type="checkbox" name="salami" id="sal" style="cursor: pointer !important;" /><label for="sal"
          style="padding-inline: 10px; cursor: pointer !important;">Salami</label>
        <p style="font-weight: bolder; flex: none;">+
          1€</p>
      </div>
      <div class="form-group" style="display: inline-flex">
        <input type="checkbox" name="tom" id="tom" style="cursor: pointer !important;" /><label for="tom"
          style="padding-inline: 10px; cursor: pointer !important;">Tomaatit</label>
        <p style="font-weight: bolder; flex: none;">+ 1€</p>
      </div>
    </div>
    <button id="btnlisaataytteet" type="button" style="display: none;">Lisää täytteet</button>
  </div>
  <div class="PermalinkOverlay" id="permalink-overlay" style="display: none"></div> <!-- tumma näyttö -->




  <div class="cons">
    <div class="left-bar-pizzerias">
      <?php

      //tämä koodi lisää kaikki ravintolat vasempaan reunaan
      $sql = "SELECT ravintolanimi FROM `Ravintolat`";
      $result = mysqli_query($con, $sql) or die(mysql_error());

      $rows = mysqli_num_rows($result);

      while ($row = mysqli_fetch_array($result)) {

        $sqlIds = "SELECT ravintolaID FROM `Ravintolat` WHERE ravintolanimi = '" . $row['ravintolanimi'] . "'";
        $id = mysqli_query($con, $sqlIds) or die(mysql_error());
        $idRow = mysqli_fetch_array($id);

        $currentID = $idRow['ravintolaID'];

        // Create a new div element
        echo "<div class='pizzeria-valinta' id=" . $currentID . ">";

        // Create an h3 header element with the "ravintolanimi" column as the text
        echo "<p style='font-size: large;'>" . $row['ravintolanimi'] . "</p>";

        // Close the div element
        echo "</div>";


      }
      
      ?>
  



      <script>

        $(document).ready(function () {
          var products = [];

          // showMessage() lisää näytölle "Tuote lisätty" tai "Tuote poistettu" tekstiä
          function showMessage(text) {
            const messageContainer = document.getElementById("message");
            messageContainer.innerHTML = text;
            messageContainer.style.opacity = 1;
            setTimeout(() => {
              messageContainer.style.opacity = 0;
            }, 2000);
          }


          const popup = document.getElementById("lisataytteet");
          const overlay = document.getElementById("permalink-overlay");
          const title = document.getElementById("pizzanimi");

          // lisaaTaytteet() lisää näytölle ikkunan josta käyttäjä pääsee valitsemaan lisätäytteet tuotteeseen
          function lisaaTaytteet(tuoNimi, tuoHinta, tuoMaara, tuoID) {
            overlay.style.display = "block";
            pizzaid.innerHTML = tuoID;
            pizzamaara.innerHTML = "x" + tuoMaara;
            pizzanimi.innerHTML = tuoNimi;
            pizzahinta.innerHTML = tuoHinta;
            lisataytteet.style.opacity = 1;
            lisataytteet.style.width = "40%";
          }

          function deleteProduct(tuoNimi) {
            var products = JSON.parse(document.getElementById("products").value);
            for (var i = 0; i < products.length; i++) {
              if (products[i].Nimi === tuoNimi) {
                products.splice(i, 1);
                break;
              }
            }
            document.getElementById("products").value = JSON.stringify(products);
          }

          function hideOverlay() {
            document.getElementById("lisataytteet").style.opacity = 0;
            document.getElementById("permalink-overlay").style.display = "none";

            document.getElementById("lisataytteet").addEventListener('transitionend', function () {
              // checkboxien valinnan poistaminen
              $("#taycombox .form-group input").prop("checked", false);
              // piilottaa napin
              $("#btnlisaataytteet").css("display", "none");
            });
          }

          var $checkboxes = $("#taycombox .form-group input[type='checkbox']");

          // näytetään nappi vain kun yksi checkboxeista on valittu
          $checkboxes.on("change", function () {
            if ($checkboxes.is(":checked")) {
              $("#btnlisaataytteet").css("display", "initial");
            } else {
              $("#btnlisaataytteet").css("display", "none");
            }
          });

          //viesti näkyville kun käyttäjä sulke ikkunan
          $("#closebutton").on("click", function () {
            hideOverlay();
            showMessage("Tuote lisätty");

            var pizzaTitle = $("#pizzanimi").text();
            var pizzaPrice = $("#pizzahinta").text();
            var pizzaAmount = $("#pizzamaara").text();
            pizzaAmount = parseInt(pizzaAmount.slice(1));

            var pizzaID = $("#pizzaid").text();

            products = JSON.parse(document.getElementById("products").value);
            if (!Array.isArray(products)) {
              products = [];
            }
            var pizzaTiedot = {
              'ID': pizzaID,
              'Nimi': pizzaTitle,
              'Hinta': pizzaPrice,
              'Maara': pizzaAmount,
            };
            products.push(pizzaTiedot);
            document.getElementById("products").value = JSON.stringify(products);

            var updatedProducts = JSON.parse(document.getElementById("products").value);
              console.log(updatedProducts);

              function updateSessionArray(updatedArray) {
                $.ajax({
                type: "POST",
                url: "update_session_products.php",
                data: {
                    updatedArray: updatedArray
                  },
                  success: function(data) {
                    console.log("Session array updated successfully");
                  }
                });
              }

                // Call updateSessionArray function after updating the products array
              var updatedProducts = JSON.parse(document.getElementById("products").value);
              updateSessionArray(updatedProducts);
          });

          $("#btnlisaataytteet").on("click", function () { //tästä otetaan lisätäytteet
            hideOverlay();

            var lisataytteetLabelit = $("#taycombox input:checked").map(function () { //tämä muuttuja sisältää lisätäytteet
              return $(this).next().text();
            }).get().join(", ");

            showMessage("Tuote lisätty. Lisätäytteet ovat " + lisataytteetLabelit);

            var pizzaTitle = $("#pizzanimi").text();
            var pizzaPrice = $("#pizzahinta").text();
            var pizzaAmount = $("#pizzamaara").text();
            pizzaAmount = parseInt(pizzaAmount.slice(1));

            var pizzaID = $("#pizzaid").text();

            products = JSON.parse(document.getElementById("products").value);
            if (!Array.isArray(products)) {
              products = [];
            }
            var pizzaTiedot = {
              'ID': pizzaID,
              'Nimi': pizzaTitle,
              'Hinta': pizzaPrice,
              'Maara': pizzaAmount,
              'Add': lisataytteetLabelit,
            }
            products.push(pizzaTiedot);
            document.getElementById("products").value = JSON.stringify(products);

            var updatedProducts = JSON.parse(document.getElementById("products").value);
              console.log(updatedProducts);

              function updateSessionArray(updatedArray) {
                $.ajax({
                type: "POST",
                url: "update_session_products.php",
                data: {
                    updatedArray: updatedArray
                  },
                  success: function(data) {
                    console.log("Session array updated successfully");
                  }
                });
              }

                // Call updateSessionArray function after updating the products array
              var updatedProducts = JSON.parse(document.getElementById("products").value);
              updateSessionArray(updatedProducts);
          });


          $(".pizzeria-valinta").click(function () { // kun käyttäjä valitsee pizzerian tuotteet näkyville:
            $(".container").css({ //container sisältää kaikki tuotteiden divit
              "background-color": "none",
              "border": "solid 3px #544a40",
              "float": "right",
              "padding": "15px",
              "border-radius": "5px",
              "margin": "20px",
              "flex-grow": "1",
              "height": "fit-content"
            });

            $('.left-bar-pizzerias .pizzeria-valinta').each(function () { // pizzerian valinnan visuaalinen toteutus
              if ($(this).hasClass('chosen')) {
                $(this).removeClass('chosen');
                $(this).removeAttr("style");
              }
            });

            $(this).toggleClass("chosen");

            if ($(this).hasClass("chosen")) {
              $(this).css({
                "background-color": "#e0d6ca",
                "float": "top",
                "padding": "15px",
                "border-radius": "5px",
                "margin": "5px"
              });
            } else {
              $(this).removeAttr("style");
            }

            var id = $(this).attr("id");

            $.post("get_tuotteet.php", { id: id }, function (data) { //saadaan tuotteet tuon tiedoston avulla.
              $.each(data, function (index, product) {
                var productDiv = $("<div>", { class: "tuotteet", id: String(product.tuoteID) });


                productDiv.append("<div class='pizzakuva'><img class='pizimg' src='" + product.kuva + "'></div><div class='description'><h3 class='pizzatitle'>" + product.tuote + "</h3><br/><p class='kuvaus'>Täytteet: " + product.taytteet + "</p><br/><p class='hinta'>" + product.hinta + "€</p></div><input type='number' class='quantity' name='quantity' min='1' max='10' value='1'><div class='lisaatuote'><button id='" + product.tuoteID + "' class='btnlisaa' type='button'>Lisää ostoskoriin</button></div>");
                productDiv.css({
                  "background-color": "#e0d6ca",
                  "float": "top",
                  "padding": "15px",
                  "border-radius": "5px",
                  "margin": "5px",
                  "display": "flex",
                  "color": "#474038"
                });

                $(".container").append(productDiv);

                $(".pizzakuva").css({
                  "width": "200px",
                  "height": "200px",
                  "object-fit": "cover",
                  "float": "left",
                  "padding": "5px",
                  "border-radius": "15px"
                });

                $(".pizimg").css({
                  "width": "100%",
                  "height": "100%",
                  "object-fit": "cover",
                  "border-radius": "15px",
                  "float": "left"

                });

                $(".description").css({
                  "flex-grow": "1",
                  "position": "relative",
                  "padding-left": "15px",
                  "width": "30%",

                });

                $(".hinta").css({
                  "font-weight": "900",
                  "position": "absolute",
                  "bottom": "0",
                  //"color": "#474038",
                  "font-size": "x-large"
                });

                $(".pizzatitle").css({
                  "font-size": "x-large",
                  "font-weight": "700",
                  //"color": "#474038"
                });

                $(".lisaatuote").css({
                  "flex-grow": "1",
                  "position": "relative",
                });

                $(".btnlisaa").css({
                  "position": "absolute",
                  "bottom": "0",
                  "padding": "15px",
                  "background-color": "#dacfc4",
                  "border-radius": "8px",
                  "border": "0px",
                  "font-size": "medium",
                  "width": "100%",
                  "overflow": "hidden",
                  "color": "#474038"
                });

                $(".quantity").css({ // LISÄTTY TUOTTEIDEN MÄÄRÄ
                  "position": "relative",
                  "margin-inline": "7px",
                  "align-self": "flex-end",
                  "height": "2vw",
                  "font-size": "initial"
                });

              });
            }, "json");

            setTimeout(() => {
              var products = <?php echo json_encode($products); ?>;
              $(".btnlisaa").each(function () {
                var btnAdd = $(this);
                var btnId = btnAdd.attr("id");
                var varName = "button#" + btnId;
                //console.log(products.length);

                if (!products) {
                  console.log("no products array found");
                } else {
                  var found = false;
                  for (var i = 0; i < products.length; i++) {
                    if (btnId === products[i].ID) {
                      console.log("found same id's:" + btnId);
                      found = true;
                      break;
                    }
                  }
                  
                  if (found) {
                    console.log("ID found in products array, updating button text and style");
                    //$(this).text("Lisätty ostoskoriin");
                    //$(this).addClass("added");
                    $(this).text("Lisätty ostoskoriin");
                    $(this).css({
                      "position": "absolute",
                      "bottom": "0",
                      "padding": "15px",
                      "background-color": "#98d984",
                      "border-radius": "8px",
                      "border": "0px",
                      "font-size": "medium",
                      "width": "100%",
                      "overflow": "hidden",
                      "opacity": "0.7"
                    });
                    $(this).hover(function () {
                      $(this).text("Poista ostoskorista");
                      $(this).css({
                       "background-color": "#d95f57"
                      });
                    }, function () {
                      $(this).text("Lisätty ostoskoriin");
                       $(this).css({
                         "background-color": "#98d984"
                       });
                     });
                  } else {
                    console.log("id not found in products array:", btnId);
                  }
                }
              });
            }, 100); 



            $(".container").empty();

          });


          let productCount = 0;
          $(document).on("click", ".btnlisaa", function () {
            var pizzaTitle = $(this).closest(".tuotteet").find(".description .pizzatitle").text();
            var pizzaPrice = $(this).closest(".tuotteet").find(".description .hinta").text();
            var pizzaAmount = $(this).closest(".tuotteet").find(".quantity").val();
            var pizzaID = $(this).closest(".tuotteet").attr('id');

            if ($(this).text() == "Lisää ostoskoriin") {
              $(this).text("Lisätty ostoskoriin");
              $(this).css({
                "position": "absolute",
                "bottom": "0",
                "padding": "15px",
                "background-color": "#dacfc4",
                "border-radius": "8px",
                "border": "0px",
                "font-size": "medium",
                "width": "100%",
                "overflow": "hidden",
                "opacity": "0.7"
              });
              $(this).hover(function () {
                $(this).text("Poista ostoskorista");
                $(this).css({
                  "background-color": "#d95f57"
                });
              }, function () {
                $(this).text("Lisätty ostoskoriin");
                $(this).css({
                  "background-color": "#98d984"
                });
              });
              // lisää täytteet ikkuna näkyville
              lisaaTaytteet(pizzaTitle, pizzaPrice, pizzaAmount, pizzaID);

              productCount++;
            
              
            } else {
              $(this).text("Lisää ostoskoriin");
              $(this).css({
                "position": "absolute",
                "bottom": "0",
                "padding": "15px",
                "background-color": "#dacfc4",
                "border-radius": "8px",
                "border": "0px",
                "font-size": "medium",
                "width": "100%",
                "overflow": "hidden",
                "opacity": "1"
              });
              $(this).off("mouseenter mouseleave");

              // Show the message
              showMessage("Tuote poistettu");

              deleteProduct(pizzaTitle);
              var updatedProducts = JSON.parse(document.getElementById("products").value);
              console.log(updatedProducts);

              function updateSessionArray(updatedArray) {
                $.ajax({
                type: "POST",
                url: "update_session_products.php",
                data: {
                    updatedArray: updatedArray
                  },
                  success: function(data) {
                    console.log("Session array updated successfully");
                  }
                });
              }

                // Call updateSessionArray function after updating the products array
              var updatedProducts = JSON.parse(document.getElementById("products").value);
              updateSessionArray(updatedProducts);

              productCount--;
            }

            if (productCount == 0) {
              $(".product-count").text('');
              $(".product-count").css({
                "visibility": "hidden"
              });
            } else {
              $(".product-count").text(productCount);
              $(".product-count").css({
                "position": "absolute",
                "top": "-10px",
                "right": "-10px",
                "display": "inline-block",
                "width": "20px",
                "height": "20px",
                "border-radius": "50%",
                "background-color": "indianred",
                "color": "#e0d6ca",
                "text-align": "center",
                "line-height": "20px",
                "font-size": "12px",
                "visibility": "visible"
              });
            
            }
          });

    

        });
      

        
      </script>

<?php
  $con->close();
?>


    </div>
    <div class="container">
    </div>
  </div>

 
</body>

</html>