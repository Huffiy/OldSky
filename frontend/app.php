<?php
session_start();
if (isSet($_SESSION['loggedin']) && $_SESSION['loggedin']){
    echo "";
}
else {
    header('Location: ./index.html');
    die;
}
?>
<!DOCTYPE html>
<head>
    <title>OldSky | Home</title>
    <link rel="stylesheet" href="./css/app.css">
</head>
<body>
    <div class="navbar">
    <form action="./playlists">
    <input type="submit" value="Le mie playlist" />
    </form>
    <form action="./profile">
    <input type="submit" value="Profilo" />
    </form>
    </div>
    <h1>OldSky</h1>
    <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
    <a href="./logout.php">Logout</a>
    <a href="./app.php">Go to app</a>

</body>