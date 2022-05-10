<?php
// check if session exists
if (!isset($_SESSION['loggedin'])) {
    header('401 Unauthorized');
}

// connect to mysql database
$db = new mysqli("localhost", "root", "rowot00", "oldsky_db");

$playlistName = $_GET['playlistName'];
$songName = $_GET['songName'];

$sql = "INSERT INTO `playlist_tracks` (`plName`, `trackName`) VALUES ('$playlistName', '$songName')";

$result = $db->query($sql);

header('Location: ./app.php');
?>

