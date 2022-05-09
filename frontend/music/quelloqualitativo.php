<?php
session_start ();
$userID = $_SESSION['userID'];
// connect to mysql database
$mysqli = new mysqli("localhost", "root", "rowot00", "oldsky_db");

$uriToAdd = $_GET['uri'];

// if uri is not defined
if (!isset($uriToAdd)) {
    echo "<h1>No uri defined</h1>";
    die;
}

$sql = "INSERT INTO liked (uri, userID) VALUES ('$uriToAdd', '$userID')";

// execute query
$mysqli->query($sql);

//check for errors
if ($mysqli->errno) {
    echo "Error: " . $mysqli->error;
}
?>