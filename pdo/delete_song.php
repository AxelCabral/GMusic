<?php
    include_once ("connection.php");
    include_once ("DAO/music_DAO.php");

    $music_id = $_GET['id'];
    $album_id = $_GET['pb'];

    $c = new connection();
    $conn = $c->connect();

    $s = new music_DAO();
    $s->delete_song($conn, $music_id);

    header("location:../album_info_art.php?id=".$album_id);
