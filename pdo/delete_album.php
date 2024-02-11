<?php
    include_once ("connection.php");
    include_once ("DAO/album_DAO.php");

    $album_id = $_GET['id'];

    $c = new connection();
    $conn = $c->connect();

    $b = new album_DAO();
    $b->delete_album($conn, $album_id);

    header("location:../index_art.php");
