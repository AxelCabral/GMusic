<?php

    include_once ('connection.php');
    include_once ('DAO/user_DAO.php');
    include_once ('classes/user.php');
  
    session_start();

    if($_SESSION['type'] == 1){
        if(isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['alt_pass'])&& $_POST['name'] != "" && $_POST['email'] != ""
        && $_POST['password'] != "" && $_POST['alt_pass'] != ""){

            $id = $_SESSION['id'];

            if($_POST['password'] == 'senhaencriptada'){
                $password = $_POST['alt_pass'];
            }
            else{
                $password = md5($_POST['password']);
            }

            $c = new connection();
            $conn = $c->connect();

            $i = new user();
            $i->setName($_POST['name']);
            $i->setEmail($_POST['email']);
            $i->setPassword($password);
            $i->setId($id);

            $edit_i = new user_DAO();
            $result_i = $edit_i->edit_profile($i, $conn);

            //Pegar somente o primeiro Nome do usuario
            $full_name = $_POST['name'];
            $words = explode(" ", $full_name);
            $first_name = $words[0];

            $_SESSION['name'] = $first_name;

            if($result_i == true){
                $_SESSION['name'] = $_POST['name'];
                if($_SESSION['type'] == 0){
                    header('location: ../profile.php?');
                }else{
                    header('location: ../art_profile.php?');
                }
            }
            else{
                header('location: ../error_2.html');
            }
        }
        else{
            header('location: ../error_2.html');
        }

    }
    else{
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        $alt_pass = strip_tags($_POST['altPass']);
        $id = $_SESSION['id'];

        if(isset($name, $email, $password, $alt_pass)){
            if($password == 'senhaencriptada'){
                $password = $alt_pass;
            }
            else{
                $password = md5($password);
            }

            $c = new connection();
            $conn = $c->connect();

            $i = new user();
            $i->setName($name);
            $i->setEmail($email);
            $i->setPassword($password);
            $i->setId($id);

            $edit_i = new user_DAO();
            $result_i = $edit_i->edit_profile($i, $conn);

            //Pegar somente o primeiro Nome do usuario
            $full_name = $name;
            $words = explode(" ", $full_name);
            $first_name = $words[0];

            $_SESSION['name'] = $first_name;
        }
        else{
            header('location: ../error_2.html');
        }
    }