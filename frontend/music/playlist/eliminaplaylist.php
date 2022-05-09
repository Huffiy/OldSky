<?php
session_start();
if (isSet($_SESSION['loggedin']) && $_SESSION['loggedin'])
    header('Location: ./app.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'playlist_name'
    ));

    $user = get_user();
    $today = date("Y-m-d");



    $sql = 'SELECT id FROM playlist WHERE name = "'.$d['playlist_name'].'" AND author_id = "'.$user['id'].'" LIMIT 1' ;
    $res = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($res);

    if ($count>0) {
        $playlist_id = mysqli_fetch_assoc($res);
        $sql = 'DELETE FROM playlist WHERE id = "'.$playlist_id['id'].'"';
        $res = mysqli_query($conn, $sql);


        response(array(
          'message' => 'play list deleted succefully!',
          'playlis_id' => $playlist_id['id']
        ));
    }
    else {
        errResponse("failed to delete playlist!");
    }
}
?>