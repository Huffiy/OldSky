<?php
session_start();
if (isSet($_SESSION['loggedin']) && $_SESSION['loggedin'])
    header('Location: ./app.php');
is_user();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'music_id',
    ));

  $user = get_user();





    $sql = 'SELECT `id` FROM music_like WHERE listener_id="'.$user['id'].'" AND music_id = "'.$d['music_id'].'" LIMIT 1';
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
      $sql = 'DELETE FROM music_like WHERE music_id="'.$d['music_id'].'" AND listener_id = "'.$user['id'].'"';
      $res = mysqli_query($conn,$sql);
      response(array(
        'message'=>'unliked successfully!',
        'music_id'=>$d['music_id']
      ));
    }
    else {

      $sql = 'INSERT INTO music_like (`listener_id`,`music_id`) VALUES("'.$user['id'].'","'.$d['music_id'].'")';
      $res = mysqli_query($conn,$sql);
      if (mysqli_errno($conn)>0) {
        errResponse(mysqli_error($conn));
      }
      response(array(
        'message' => 'music liked successfully!',
        'music_id'=>$d['music_id']
      ));


    }
  }
 ?>