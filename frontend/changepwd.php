<?php 
// check session
if (!isset($_SESSION['loggedin'])) {
    header('401 Unauthorized');
}

?>

<h1>Cambia password</h1> <br>
<form action="doChangepwd.php" method="post">
    <input type="password" name="newpwd" placeholder="Nuova password">
    <button type="submit">Cambia password</button>
</form>
