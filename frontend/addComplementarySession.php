<?php
session_start();
$user = $_SESSION['username'];

// if session is not set
if (!isset($_SESSION['username'])) {
    header('401 Unauthorized');
}

// connect to sql database
$db = new mysqli("localhost", "root", "rowot00", "oldsky_db");

// get user session id from database using username
$sql = "SELECT userID FROM users WHERE username = '$user'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$userID = $row['userID'];

$_SESSION['userID'] = $userID;
header('Location: ./app.php');
?>