<?php
require('db.php');
session_start();
$email = $_SESSION["email"];


$products = unserialize(html_entity_decode($_POST['products']));


 if(isset($_SESSION['email'])){

$kayttajaID = intval($_POST['kayttajaID']);
$etunimi = $_POST['etunimi'];
$sukunimi = $_POST['sukunimi'];
$puhelin = $_POST['puhelin'];
$email = $_POST['email'];
$lisatiedot = $_POST['lisatiedot'];
$toimitusosoite = $_POST['toimitusosoite'];

foreach ($products as $product) {
  $maara = $product["Maara"];
  if ($maara > 1) {
    $lisatiedot .= PHP_EOL . $product['Nimi'] . " x" . $maara;
  }
  if (isset($product["Add"])) {
    $lisatiedot .= PHP_EOL . $product["Nimi"] . " lisätäytteet: " . $product["Add"];
  }
}



$query    = "INSERT INTO Tilaukset (asiakasID, etunimi, sukunimi, puhelin, email, lisatiedot, toimitusosoite)
             VALUES ($kayttajaID, '$etunimi', '$sukunimi', '$puhelin', '$email', '$lisatiedot', '$toimitusosoite')";


$result   = mysqli_query($con, $query);

$queryTilaus = "SELECT tilausID FROM Tilaukset ORDER BY tilausID DESC LIMIT 1";
$tilausResult = mysqli_query($con, $queryTilaus);
$tilausRow = mysqli_fetch_array($tilausResult);
$tilausID = $tilausRow['tilausID'];

$query2 = "INSERT INTO Tilaukset_Tuotteet (tilausID, tuoteID) VALUES ";

foreach ($products as $product) {
  $tuoteID = $product["ID"];
  $query2 .= "($tilausID, $tuoteID),";
}

$query2 = rtrim($query2, ",");

$result2 = mysqli_query($con, $query2);
if ($result2) {
    header("Location:tilausvahvistus.php");

    unset($_SESSION['products']);
   
}
else{
  echo "<script>alert('Tilauksessa tapahtui virhe. Yritä uudestaan'); window.location='kassa.php'</script>";
   header("Location:kassa.php");
   
}

 }


 

 




$con->close();

?>