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
$db = new mysqli('localhost', 'root', 'pa$$w0rd', 'oldsky_db');

//Check sql connection
if ($db->connect_error) {
    die('Connect Error (' . $db->connect_errno . ') '
            . $db->connect_error);
}

// Sign up 
$query = "INSERT INTO users (username, password) VALUES ('$user', '$pwd')";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>


    <title>OLD SKY SPOTIFY</title>
    <img src='img/spotify.png' alt ='logo'>




     <style media="screen">
        *,
  *:before,
  *:after{
      padding: 0;
      margin: 0;
      box-sizing: border-box;
  }

  body{
    background-color: black;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}



form{
    height: 500px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 60%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}

form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(29, 226, 108, 0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}

::placeholder{
    color: #4CAF50;
}

.social{
  margin-top: 30px;
  display: flex;
}

.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}
form p{
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

    </style>
</head>
<body>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form action="index.html" method="get">
        <h2 placeholder="username">Sei stato registrato!</h2>
        <input type="submit" value="Vai al login">
        </div>
    </form>

    <form action="index.html" method="get">
        <h2 placeholder="username">Sei stato registrato!</h2>
        <a href="index.html">Vai al login</a>
        </div>
    </form>

    

    </html>