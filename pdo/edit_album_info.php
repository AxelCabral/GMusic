<?php

    include_once ('connection.php');
    include_once ('DAO/album_DAO.php');
    include_once ('classes/album.php');
    
    if(isset($_POST['name'], $_POST['a_name'], $_POST['id'])&& $_POST['name'] != "" && $_POST['a_name'] != "" && 
    $_POST['id'] != ""){

        $c = new connection();
        $conn = $c->connect();

        $i = new album();
        $i->setName($_POST['name']);
        $i->setArtistName($_POST['a_name']);
        $i->setId($_POST['id']);

        $edit_i = new album_DAO();
        $result_i = $edit_i->edit_album($i, $conn);

        echo $result_i;

        if($result_i == true){
            header('location: ../index_art.php');
        }
        else{
            header('location: ../error_2.html');
        }
    }
    else{
        header('location: ../error_2.html');
    }
