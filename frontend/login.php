<?php 
$user = $_POST['username'];
$pwd = $_POST['password'];

//Connect to a mysql database
$db = new mysqli('localhost', 'root', '', 'test');

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
}
else {
    echo "Login failed";
}
?>