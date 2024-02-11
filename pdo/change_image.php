<?php
    if(isset($_FILES['profile-image'], $_POST['email'])){

        $extension = strtolower(substr($_FILES['profile-image']['name'], -4));
        $new_name = md5($_POST['email']).'.gif';
        $directory = "../assets/images/user_images/";

        move_uploaded_file($_FILES['profile-image']['tmp_name'], $directory.$new_name);

        $randomNumber = rand(0,10000);  

        $_SESSION['icon'] = $new_name;
        header('location: ../art_profile.php?'.$randomNumber);
    }
    else{
        header('location: ../error_2.html');
    }
