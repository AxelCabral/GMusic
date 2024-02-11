<?php
    include_once ('connection.php');
    include_once ('DAO/user_DAO.php');

    session_start();

    if(empty($_SESSION['id'])){
        header('location: ../index.php');
    }

    $user_id = $_SESSION['id'];

    if($_SESSION['type'] == 0){
        $artist_id = strip_tags($_GET['artist_id']);
        if(empty($artist_id)){
            header('location: ../error_2.html');
        }
        else{
            $artist_id = strip_tags($_GET['artist_id']);
        
            date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para São Paulo 
            $date = date('Y-m-d');

            $c = new connection();
            $conn = $c->connect();

            $f = new user_DAO();
            $new_f = $f->new_follow($conn, $artist_id, $user_id, $date);
        }
    }
    else
    {
        if(isset($_GET['id'])){
            $artist_id = $_GET['id'];
    
            date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para São Paulo 
            $date = date('Y-m-d');
    
            $c = new connection();
            $conn = $c->connect();
    
            $f = new user_DAO();
            $new_f = $f->new_follow($conn, $artist_id, $user_id, $date);
    
            if($new_f == true){
                header('location: ../artistic_profile.php'); 
            }
            else{
                header('location: ../error_2.html');
            }
        }
        else{
            header('location: ../error_2.html');
        }
    }
