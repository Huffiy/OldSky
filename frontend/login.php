<?php 
session_start();
if (isSet($_SESSION['loggedin']) && $_SESSION['loggedin']){
    header('Location: ./app.php');
}
else {
    echo "";
}
$user = $_POST['username'];
$pwd = $_POST['password'];

//Connect to a mysql database
$db = new mysqli('localhost', 'root', 'rowot00', 'oldsky_db');

//Check sql connection
if ($db->connect_error) {
    die('Connect Error (' . $db->connect_errno . ') '
            . $db->connect_error);
}

//Compare username and password
$query = "SELECT * FROM users WHERE username = '$user' AND password = '$pwd'";
$result = $db->query($query);

//Login success
if ($result->num_rows > 0) {
    echo "Login success";
    // save a session
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $user;
    header('Location: ./addComplementarySession.php');
}
else {
    echo "Login failed";
    header('Location: ./login_failed.html');
}
?>