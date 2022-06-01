<?php
// check session
session_start();
if (isSet($_SESSION['loggedin'])){
    echo '';
}
else {
    header("HTTP/1.1 401 Unauthorized");
    die;
}

$searchInput = $_GET['search'];
// transform spaces to +
$searchInput = str_replace(' ', '+', $searchInput);

// get content through http
$url = "http://localhost:8999/songsearch?artistsearch=$searchInput";
$content = file_get_contents($url);

// store json content into array
$json = json_decode($content, true);

//$json['title']

?>
<!DOCTYPE html>
<head>
    <title>OldSky | Home</title>
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>

<div class="topnav">
<a class="active" href="app.php">Player</a>
<a href="app.php">Home</a>
  <a href="my_playlists.php">Le mie playlist</a>
  <a href="my_liked.php">Preferiti</a>
  <a href="my_profile.php">Profilo</a>
  <a href="logout.php">Logout</a>
    <form action="search.php" method="get">
        <input type="text" name="search" placeholder="Cerca una canzone">
    </form>

</div>

<div style="padding-left:16px">

    <h1>OldSky Player</h1>
    <center>
        <h2><?php echo $json['trackName']; ?></h2>
        <img src="<?php echo $json['trackImg']?>" width="500" height="500" alt="Track Image"> <br>
        <audio controls>
            <source src="<?php echo $json['trackMP3']?>" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio> <br>
        <a href="./addtoLiked.php?track=<?php echo $searchInput?>">[ Aggiungi ai preferiti ]</a> 
        <a href="./addtoPlaylist.php?trackName=<?php echo $searchInput?>">[ Aggiungi ad una playlist ]</a>

        
    </center>
    </div>
</body>