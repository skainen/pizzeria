<header class="header"> 
    <div class="etusivu">
        <a href="etusivu.php"><div id="etusivulle" class="fa-solid fa-house-chimney"></div></a>
</div>

    <!-- Yläpalkin tekstit -->
        <a href="pizzeriat.php">Pizzeriat</a>
        <a href="tuotteet.php">Tuotteet</a>
        <a href="otayhteytta.php">Ota yhteyttä</a>
        

    <div class="icons">

        <?php

if(isset($_SESSION["email"])){
  echo "<a href='kassa.php'><div id='kassa' class='fa-solid fa-cart-shopping'></div></a>";
}
else{
  echo "<a href='regis.php'><div id='kassa' class='fa-solid fa-cart-shopping'></div></a>";
}



      //Käyttäjäikoni vie rekisteröinti sivulle käyttäjä ei ole
      // kirjautunut sisään, ja profiili sivulle jos on.

      if(isset($_SESSION["email"])){
        echo "<a href='profiili.php'><div id='profiili' class='fa-solid fa-user'></div></a>";
      }
      else {
        echo "<a href='regis.php'><div id='regis' class='fa-solid fa-user'></div></a>";
      }

      // Logout nappi jos kirjauduttu sisään.

      if(isset($_SESSION["email"])){
        echo "<a href = 'logout.php'><div id='logout' class='fa-solid fa-right-from-bracket'></div></a>";
      }
      else {
        
      }
     
     ?>
       </div>

</header>