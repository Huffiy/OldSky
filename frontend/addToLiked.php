<?php
// start session
session_start();
$likedTrack = $_GET['track'];
$userID = $_SESSION['userID'];

// connect to mysql
$mysqli = new mysqli("localhost", "root", "rowot00", "oldsky_db");

// sql query
$sql = "INSERT INTO `liked` (`userID`, `track_name`) VALUES ('$userID', '$likedTrack')";

// execute sql query
$mysqli->query($sql);

header('Location: ./app.php');
?>