<?php
session_start();
// check if session is set
if (!isset($_SESSION['loggedin'])) {
    header("HTTP/1.1 401 Unauthorized");
    die;
}
$userID = $_SESSION['userID'];

// connect to mysql database
$db = new mysqli("localhost", "root", "rowot00", "oldsky_db");

// get all contents from table liked
$sql = "SELECT * FROM `users` WHERE `userID` = $userID";
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
<a href="app.php">Home</a>
  <a href="my_playlists.php">Le mie playlist</a>
  <a href="my_liked.php">Preferiti</a>
  <a class="active" href="my_profile.php">Profilo</a>
  <a href="logout.php">Logout</a>
    <form action="search.php" method="get">
        <input type="text" name="search" placeholder="Cerca una canzone">
    </form>
</div>

<div style="padding-left:16px">

    <h1>OldSky | Il mio profilo</h1>
    <h2>Nome Utente: <?php echo $_SESSION['username'];?></h2> <br>
    <h2>User ID: <?php echo $_SESSION['userID'];?></h2> <br> <br>
    <a href="changepwd.php">[ Cambia password ]</a> <a href="deleteaccount.php">[ Elimina account ]</a>

    </div>
</body>