<?php
    include_once ('connection.php');
    include_once ('DAO/user_DAO.php');

    if(isset($_POST['email'], $_POST['password'])&& $_POST['email'] !="" && $_POST['password'] != ""){

        $email = $_POST['email'];
        $pass = (md5($_POST['password']));

        $c = new connection();
        $conn = $c->connect();

        session_start();
        $login = new user_DAO();
        $login -> login($email, $pass, $conn);
    }
    if(isset($_SESSION['id'], $_SESSION['type'])){
        if($_SESSION['type'] == 0){
            header('location: ../index.php');
        }
        else if($_SESSION['type'] == 1){
            header('location: ../index_art.php');
        }
    }
    else{
        session_destroy();
        header('location: ../error_2.html');
    }
?>