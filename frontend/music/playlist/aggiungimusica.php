<?php
session_start();
if (isSet($_SESSION['loggedin']) && $_SESSION['loggedin']){
    header('Location: ./app.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
      'playlist_id',
      'music_id'
    ));

    $user = get_user();
    $today = date("Y-m-d");



    $sql = 'SELECT listener_id FROM playlist_user WHERE listener_id = "'.$user['id'].'" AND playlist_id = "'.$d['playlist_id'].'" LIMIT 1' ;
    $res = mysqli_query($conn,$sql);
    $row_num = mysqli_fetch_assoc($res);
    $count = $row_num['listener_id'];

    if ($count>0) {
        $sql = 'SELECT COUNT(*) as num  FROM playlist_music WHERE playlist_id = "'.$d['playlist_id'].'" AND music_id = "'.$d['music_id'].'"';
        $res = mysqli_query($conn,$sql);
        $row_num = mysqli_fetch_assoc($res);
        $count = $row_num['num'];
        if ($count<1) {
          $sql = 'INSERT INTO playlist_music (playlist_id, music_id, date) VALUES("'.$d['playlist_id'].'", "'.$d['music_id'].'", "'.$today.'")';
          $res = mysqli_query($conn, $sql);
          response(array(
            'message' => "music added to play list succefully!",
            'playlist_id' => $d['playlist_id'],
            'msuic_id' => $d['music_id']
          ));
      }
      else {
        errResponse("the music already exist in the playlist.");
      }
    }
    else {
        errResponse("you have no access to this play list");
    }
}
?>