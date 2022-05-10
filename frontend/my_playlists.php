<?php
session_start();
// check if session is set
if (!isset($_SESSION['loggedin'])) {
    header('401 Unauthorized');
}
$userID = $_SESSION['userID'];

// connect to mysql database
$db = new mysqli("localhost", "root", "rowot00", "oldsky_db");

// get all contents from table liked
$sql = "SELECT * FROM playlist WHERE `userID` = '$userID'";
$result = $db->query($sql);
?>
<!DOCTYPE html>
<head>
    <title>OldSky | Home</title>
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>

<div class="topnav">
<a class="active" href="#home">Le mie playlist</a>
  <a href="app.php">Home</a>
</div>

<div style="padding-left:16px">

    <h1>OldSky | Le tue playlist</h1>

    <form action="createPlaylist.php" method="get">
        <input type="text" name="playlistName" placeholder="Crea una playlist">
        <button type="submit">➕</button>
    </form>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo $row['name'] . '<a href="./playlistView.php?name=' . $row['name'] . '">➡️</a> <br>';
    }
    ?>

    </div>
</body>