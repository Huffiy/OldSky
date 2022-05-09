<?php
session_start();
if (isSet($_SESSION['loggedin']) && $_SESSION['loggedin'])
    header('Location: ./app.php');
if (!is_verified()) {
  errResponse('Artist is not verified yet!',403);
}
$artist = get_artist();
$artist_id = $artist['user_id'];

if (isset($_GET['album_id']) ) {
  $id = $_GET['album_id'];
  if ($_SERVER['REQUEST_METHOD'] === 'DELETE' ) {
    $sql = 'SELECT * FROM album WHERE id ='.$id.' LIMIT 1';
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)<1){
      errResponse('there is no album with id '.$id.'');
    }

    $sql = 'SELECT * FROM album WHERE id ='.$id.' AND artist_id = '.$artist_id.' ';

    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
      $sql = 'DELETE FROM album WHERE id = '.$id.' ';
      $res = mysqli_query($conn,$sql);
      if (mysqli_errno($conn)>0) {
        errResponse(mysqli_error($conn));
      }
      response(array(
        'message'=>'album with id '.$id.' deleted successfully'
      ));
    }
    else {
      errResponse('permission denied!');
    }

  }elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

  }
}elseif (isset($_GET['music_id'])) {
  $music_id = $_GET['music_id'];
  if ($_SERVER['REQUEST_METHOD'] === 'DELETE' ) {
    $sql = 'SELECT album_id FROM music WHERE id ='.$music_id.' LIMIT 1';
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)<1){
      errResponse('there is no music with id '.$music_id.'');
    }
    $album_id = (mysqli_fetch_assoc($res))['album_id'];


    $sql = 'SELECT * FROM album WHERE id ='.$album_id.' AND artist_id = '.$artist_id.' ';
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res)>0) {
      $sql = 'DELETE FROM music WHERE id = '.$music_id.' ';
      $res = mysqli_query($conn,$sql);
      if (mysqli_errno($conn)>0) {
        errResponse(mysqli_error($conn));
      }
      response(array(
        'message'=>'music with id '.$music_id.' from album with id '.$album_id.' deleted successfully'
      ));
    }
    else {
      errResponse('permission denied!');
    }
}

else{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //create album
    $d = get_posted_data(array(
      'name',
      'genre',
      'publish_datetime',
      'musics'
    ));
    $musics = $d['musics'];
    if (count($musics)<1) {
      errResponse('you should add atleast one music!');
    }
    $album_name = $d['name'];
    if (count($musics)<2) {
      $album_name = ($musics[0])['name'];
    }
    $sql ='INSERT INTO album (`name`, `artist_id`,`genre`, `publish_datetime`) VALUES("'.$album_name.'","'.$artist_id.'","'.$d['genre'].'","'.$d['publish_datetime'].'")';
    $res = mysqli_query($conn,$sql);
    if (mysqli_errno($conn)>0) {
      errResponse(mysqli_error($conn));
    }
    $sql = 'SELECT MAX(id) as id FROM album LIMIT 1';
    $res = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($res);
    $album_id = $data['id'];


    for ($i=0; $i < count($musics) ; $i++) {
      $music = $musics[$i];
      $sql = 'INSERT INTO music(`name`,`album_id`,`duration`) VALUES("'.$music['name'].'",'.$album_id.',"'.$music['duration'].'")';
      $res = mysqli_query($conn,$sql);
      if (mysqli_errno($conn)>0) {
        errResponse(mysqli_error($conn));
      }
    }

    response(array(
      'message' => 'album with id : '.$album_id.' and '.count($musics).' music created!'
    ));

  } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

  }

}
}

?>