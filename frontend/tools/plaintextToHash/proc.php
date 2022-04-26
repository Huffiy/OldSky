<?php
$plaintext = $_GET["plaintext"];
$hashed = password_hash($plaintext, PASSWORD_DEFAULT);
?>
<b>Plaintext: </b> <?php echo $plaintext;?> <br>
<b>Hash: </b> <?php echo $hashed;?> <br>