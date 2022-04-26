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
</head>
<body>
    <h1>OldSky</h1>
    <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
    <a href="./logout.php">Logout</a>
    <a href="./app.php">Go to app</a>
</body>