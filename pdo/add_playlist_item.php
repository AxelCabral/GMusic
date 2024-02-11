<?php
    include_once ('DAO/playlist_DAO.php');
    include_once ('connection.php');

    $music_id = strip_tags($_GET['music_id']);
    $playlist_id = strip_tags($_GET['playlist_id']);

    if(isset($music_id, $playlist_id)){

        echo "<script>alert('aaa')</script>";

        $c = new connection();
        $conn = $c->connect();

        $new_pl = new playlist_DAO();
        $new_pl_item = $new_pl->add_playlist_song($conn, $playlist_id, $music_id);
    }
    else{
        header('location: ../error.html');
    }
