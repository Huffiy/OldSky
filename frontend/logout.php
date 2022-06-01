<?php 
session_start();
session_destroy();
header('Location: ./app.php');

session_unset();
unset($_SESSION['loggedin']);
?>