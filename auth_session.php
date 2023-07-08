<?php
    session_start();
    if(!isset($_SESSION["kayttajaID"])) {
        header("Location: login.php");
        exit();
    }
?>