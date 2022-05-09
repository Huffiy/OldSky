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
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>

<div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#news">Le mie playlist</a>
  <a href="#contact">Preferiti</a>
  <a href="./myprofile.php">Profilo</a>
  <a href="logout.php">Logout</a>
    <form action="search.php" method="get">
        <input type="text" name="search" placeholder="Search..">
        <button type="submit">Search</button>
    </form>
</div>

<div style="padding-left:16px">

    <h1>OldSky</h1>
    <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
    </div>
</body>