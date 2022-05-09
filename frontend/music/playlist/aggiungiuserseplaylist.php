<?php
session_start();
if (isSet($_SESSION['loggedin']) && $_SESSION['loggedin'])
    echo "";
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
      'playlist_id',
      'user_id'
    ));

    $user = get_user();
    $today = date("Y-m-d");

$sql = 'SELECT COUNT(*) as num FROM playlist WHERE author_id="'.$user['id'].'" AND id="'.$d['playlist_id'].'"';
$res = mysqli_query($conn, $sql);
$table = mysqli_fetch_assoc($res);
$count = $table['num'];

if ($count>0) {
    $sql='INSERT INTO playlist_user (`listener_id`,`playlist_id`) VALUES("'.$d['user_id'].'","'.$d['playlist_id'].'" ) ';
    $res = mysqli_query($conn, $sql);
    if (mysqli_errno($conn)>0) {
      errResponse(mysqli_error($conn));
    }
    response(array(
      'user_id'=>$d['user_id'],
      'playlist_id'=>$d['playlist_id']
    ));


}
errResponse("failed to add!");




}
?>