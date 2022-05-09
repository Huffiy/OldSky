<?php
session_start();
if (isSet($_SESSION['loggedin']) && $_SESSION['loggedin']){
    header('Location: ./app.php');
is_user();

    

    $user = get_user();
    $today = date("Y-m-d");
    if (is_premium()) {
      $sql = 'INSERT INTO playlist (author_id, name, datetime) VALUES("'.$user['id'].'", "'.$d['name'].'", "'.$today.'")';
      $res = mysqli_query($conn, $sql);

      $sql = 'SELECT id FROM playlist WHERE id = (SELECT MAX(id) FROM playlist WHERE author_id = "'.$user['id'].'")';
      $res = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($res);
      $playlist_id = $row['id'];

      $sql = 'INSERT INTO playlist_user (listener_id,playlist_id) VALUES("'.$user['id'].'","'.$playlist_id.'")';
      $res = mysqli_query($conn,$sql);

      response(array(
        'user' => $user['id'],
        'name' => $d['name'],
        'date' => $today,
        'playlist_id'=>$playlist_id
      ));
    }



    $sql = 'SELECT COUNT(*) as num FROM playlist WHERE author_id = "'.$user['id'].'"' ;
    $res = mysqli_query($conn,$sql);
    $row_num = mysqli_fetch_assoc($res);
    $count = $row_num['num'];

    if ($count<5) {
        $sql = 'INSERT INTO playlist (author_id, name, datetime) VALUES("'.$user['id'].'", "'.$d['name'].'", "'.$today.'")';
        $res = mysqli_query($conn, $sql);

        $sql = 'SELECT id FROM playlist WHERE id = (SELECT MAX(id) FROM playlist WHERE author_id = "'.$user['id'].'")';
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($res);
        $playlist_id = $row['id'];

        $sql = 'INSERT INTO playlist_user (listener_id,playlist_id) VALUES("'.$user['id'].'","'.$playlist_id.'")';
        $res = mysqli_query($conn,$sql);

        response(array(
          'user' => $user['id'],
          'name' => $d['name'],
          'date' => $today,
          'playlist_id'=>$playlist_id
        ));
    }
    else {
        errResponse("you have reached the maximum number of playlists");
    }
}
?>