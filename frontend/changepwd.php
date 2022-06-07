<?php 
// check session
session_start();
if (isSet($_SESSION['loggedin']) && $_SESSION['loggedin']){
    echo "";
}
else {
    header('HTTP 1.1 401 Unauthorized');
    die;
}

?>

<h1>Cambia password</h1> <br>
<form action="doChangepwd.php" method="post">
    <input type="password" name="newpwd" placeholder="Nuova password">
    <button type="submit">Cambia password</button>
</form>
