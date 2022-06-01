<?php
// start session
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("HTTP/1.1 401 Unauthorized");
    die;
}
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