<?php
require('db.php');
session_start();
$products = $_SESSION['products'];
//get the id from the POST data
$id = $_POST['id'];

//query the database
$query_yhteydet = "SELECT tuoteID FROM `Ravintolat_Tuotteet` WHERE ravintolaID=" . $id;
$result = $con->query($query_yhteydet);
//fetch the data
$data = array();
while ($row = $result->fetch_assoc()) {
    //$data[] = $row;
    $query_tuotteet = "SELECT tuote, hinta, kuva, taytteet FROM `Tuotteet` WHERE tuoteID=" . $row['tuoteID'];
    $tuotteet_nimet = $con->query($query_tuotteet);
    $tuote_row = $tuotteet_nimet->fetch_assoc();
    $row['tuote'] = $tuote_row['tuote'];
    $row['hinta'] = $tuote_row['hinta'];
    $row['kuva'] = $tuote_row['kuva'];
    $row['taytteet'] = $tuote_row['taytteet'];
    $data[] = $row;
}



//return the data as JSON
echo json_encode($data);
?>