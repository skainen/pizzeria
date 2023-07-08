<?php
session_start();
if (isset($_POST['updatedArray'])) {
    $_SESSION['products'] = $_POST['updatedArray'];
}
?>