<?php
    include_once ('classes/user.php');
    include_once ('DAO/user_DAO.php');
    include_once ('connection.php');

    if(isset($_POST['name'], $_POST['password'], $_POST['email'], $_FILES['icon'], $_POST['user-type'], 
    $_POST['password-c'])&& $_POST['name'] != "" && $_POST['password'] !="" && $_POST['email'] !="" 
    && $_POST['password-c'] !=""){

        $extension = strtolower(substr($_FILES['icon']['name'], -4));
        $new_name = md5($_POST['email']).'.gif';
        $directory = "../assets/images/user_images/";

        if($_POST['password'] == $_POST['password-c']){

            $c = new connection();
            $conn = $c->connect();

            $u = new user();
            $u->setName($_POST['name']);
            $u->setEmail($_POST['email']);
            $u->setPassword(md5($_POST['password']));
            $u->setIcon($new_name);
            $u->setType($_POST['user-type']);
        
            $insert_u = new user_DAO();
            $result_u = $insert_u->insert_user($u, $conn);

            move_uploaded_file($_FILES['icon']['tmp_name'], $directory.$new_name);

            if($result_u == true){
                $result_u = "Você realizou seu registro com sucesso!";

                session_start();
                $login = new user_DAO();
                $login -> login($_POST['email'], (md5($_POST['password'])), $conn);
            }
            else{
                $result_u = "Ocorreu um erro durante o processo de cadastro, por favor tente novamente.";
            }

        }
        else{
            $result_u = "Erro! as senhas informadas não coincidem.";
        }
    }
    else{
        $result_u = "Ocorreu um erro, todos os campos precisam ser preenchidos.";
    }
    echo "alert(',$result_u,')";
    header('location: ../index.php');
?>