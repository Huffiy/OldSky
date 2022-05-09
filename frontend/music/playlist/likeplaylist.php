<?php
session_start();
if (isSet($_SESSION['loggedin']) && $_SESSION['loggedin'])
    header('Location: ./app.php');
is_user();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'playlist_id',
    ));

  $user = get_user();

    $sql = 'SELECT `id` FROM playlist_like WHERE listener_id="'.$user['id'].'" AND playlist_id = "'.$d['playlist_id'].'" LIMIT 1';
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
      $sql = 'DELETE FROM playlist_like WHERE playlist_id="'.$d['playlist_id'].'" AND listener_id = "'.$user['id'].'"';
      $res = mysqli_query($conn,$sql);
      response(array(
        'message'=>'unliked successfully!',
        'playlis_id'=>$d['playlist_id']
      ));
    }
    else {

      $sql = 'INSERT INTO playlist_like (`listener_id`,`playlist_id`) VALUES("'.$user['id'].'","'.$d['playlist_id'].'")';
      $res = mysqli_query($conn,$sql);
      if (mysqli_errno($conn)>0) {
        errResponse(mysqli_error($conn));
      }
      response(array(
        'message' => 'playlist liked successfully!',
        'playlist_id'=>$d['playlist_id']
      ));


    }
  }
 ?>