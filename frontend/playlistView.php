<?php
session_start();
// check if session is set
if (!isset($_SESSION['loggedin'])) {
    header("HTTP/1.1 401 Unauthorized");
    die;
}
$userID = $_SESSION['userID'];
$plName = $_GET['name'];

// connect to mysql database
$db = new mysqli("localhost", "root", "rowot00", "oldsky_db");

// get all contents from table liked
$sql = "SELECT * FROM playlist_tracks WHERE `plName` = '$plName' AND `plUserID` = '$userID'";
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
<a class="active" href="#home">Playlist: <?php echo $plName;?></a>
  <a onclick="history.back()">Indietro</a>
</div>

<div style="padding-left:16px">

    <h1><?php echo $plName;?></h1>

    <?php
    while ($row = $result->fetch_assoc()) {
        echo $row['trackName'] . '<a href="./search.php?search=' . $row['trackName'] . '">🔊</a> <br>';
    }
    ?>

    </div>
</body>