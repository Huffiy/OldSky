<?php 
session_start();
// check user session
if (!isset($_SESSION['loggedin'])) {
    header('401 Unauthorized');
}

// connect to mysql database
$db = new mysqli("localhost", "root", "rowot00", "oldsky_db");

// delete user account from database
$userID = $_SESSION['userID'];
$sql = "DELETE FROM `users` WHERE `userID` = '$userID'";

// execute query
$result = $db->query($sql);

// delete all session
session_destroy();

header('Location: ./index.html');
?>