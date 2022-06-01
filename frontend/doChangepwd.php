<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("HTTP/1.1 401 Unauthorized");
    die;
}
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