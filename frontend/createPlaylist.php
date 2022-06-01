<?php
// start session
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("HTTP/1.1 401 Unauthorized");
    die;
}
$playlistName = $_GET['playlistName'];
$userID = $_SESSION['userID'];

// connect to mysql
$mysqli = new mysqli("localhost", "root", "rowot00", "oldsky_db");

// sql query
$sql = "INSERT INTO `playlist` (`userID`, `name`) VALUES ('$userID', '$playlistName')";

// execute sql query
$mysqli->query($sql);

header('Location: ./my_playlists.php');
?>