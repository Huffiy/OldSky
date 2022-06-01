<?php 
// check session
if (!isset($_SESSION['loggedin'])) {
    header("HTTP/1.1 401 Unauthorized");
    die;
}

?>

<h1>Cambia password</h1> <br>
<form action="doChangepwd.php" method="post">
    <input type="password" name="newpwd" placeholder="Nuova password">
    <button type="submit">Cambia password</button>
</form>
