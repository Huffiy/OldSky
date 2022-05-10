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
$sql = "SELECT * FROM liked WHERE `userID` = '$userID'";
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
<a class="active" href="#home">Preferiti</a>
  <a href="app.php">Home</a>
</div>

<div style="padding-left:16px">

    <h1>OldSky | Preferiti</h1>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo $row['track_name'] . '<a href="./search.php?search=' . $row['track_name'] . '">🔊</a> <br>';
    }
    ?>

    </div>
</body>