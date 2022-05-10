<?php
// start session
session_start();
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