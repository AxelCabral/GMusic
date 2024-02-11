<?php
    include_once ("connection.php");
    include_once ("DAO/playlist_DAO.php");

    $playlist_id = strip_tags($_GET['playlist_id']);

    if(isset($playlist_id)){
        $c = new connection();
        $conn = $c->connect();

        $b = new playlist_DAO();
        $b->delete_playlist($conn, $playlist_id);
    }
    else{
        header("location:../error.php");
    }
