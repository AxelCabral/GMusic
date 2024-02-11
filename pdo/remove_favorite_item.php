<?php
    include_once ('DAO/music_DAO.php');
    include_once ('connection.php');

    session_start();
    $user_id = $_SESSION['id'];
    $music_id = strip_tags($_GET['music_id']);

    if(isset($user_id, $music_id)){

        $c = new connection();
        $conn = $c->connect();

        $new_fav = new music_DAO();
        $new_fav_item = $new_fav->remove_favorite_song($conn, $user_id, $music_id);
    }
    else{
        header('location: ../error.html');
    }
