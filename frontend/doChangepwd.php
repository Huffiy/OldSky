<?php
session_start();
// connect to sql database
$db = new mysqli("localhost", "root", "rowot00", "oldsky_db");

// change password for user
$userID = $_SESSION['userID'];
$newPassword = $_POST['newpwd'];

$sql = "UPDATE `users` SET `password` = '$newPassword' WHERE `userID` = '$userID'";

// execute query
$result = $db->query($sql);

header('Location: ./app.php');
?>