<?php

    include_once ('connection.php');

    if(isset($_FILES['album-image'], $_POST['id'], $_POST['route'])){

        $id = $_POST['id'];
        $image = $_POST['route'];

        $extension = strtolower(substr($_FILES['album-image']['name'], -4));
        $new_name = $image;
        $directory = "../assets/images/album_images/";

        move_uploaded_file($_FILES['album-image']['tmp_name'], $directory.$new_name);

        header('location: ../edit_album.php?id='.$id);
    }
    else{
        header('location: ../error_2.html');
    }
