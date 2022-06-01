<?php
session_start();
// check if session exists
if (!isset($_SESSION['loggedin'])) {
    header("HTTP/1.1 401 Unauthorized");
}

// connect to mysql database
$db = new mysqli("localhost", "root", "rowot00", "oldsky_db");

$playlistName = $_GET['playlistName'];
$songName = $_GET['songName'];
$userid = $_SESSION['userID'];

$sql = "INSERT INTO `playlist_tracks` (`plName`, `trackName`, `plUserID`) VALUES ('$playlistName', '$songName', '$userid')";

$result = $db->query($sql);

header('Location: ./app.php');
?>

