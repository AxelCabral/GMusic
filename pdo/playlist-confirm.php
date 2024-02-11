<?php
    include_once ('classes/playlist.php');
    include_once ('DAO/playlist_DAO.php');
    include_once ('connection.php');

    if(isset($_FILES['song_file'], $_POST['song_name'])){

        $extension = strtolower(substr($_FILES['song_file']['name'], -4));
        $new_name = md5(time()).'.gif';
        $directory = "../assets/images/playlist_images/";

        date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para São Paulo 
        // Isso previne que a criação de playlist cadastre a data errada de criação
        $date = date('Y-m-d');

        session_start();
        $user_id = $_SESSION['id']; //Define o id do usuário que está criando a playlist

        $c = new connection();
        $conn = $c->connect();

        $p = new playlist();
        $p->setName($song_name);
        $p->setDate($date);
        $p->setCoverRoute($new_name);
        $p->setIdUser($user_id);
        
        $insert_p = new playlist_DAO();
        $result_p = $insert_p->insert_playlist($p, $conn);

        move_uploaded_file($_FILES['songFile']['tmp_name'], $directory.$new_name);
    }
    else{
        //header('location: ../error.html');
    }
?>
<p><?php
 echo $_POST['song_name'];
 print_r($_FILES['song_file']);
 ?></p>