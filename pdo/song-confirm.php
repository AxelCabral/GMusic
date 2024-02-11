<?php
    include_once ('connection.php');
    include_once ('classes/music.php');
    include_once ('DAO/music_DAO.php');

    if(isset($_POST['seconds'], $_POST['minutes'], $_FILES['song'], $_POST['name'], $_POST['album_id'])){

        $album_id = $_POST['album_id'];
        $song_name = $_POST['name'];
        $minutes = $_POST['minutes'];
        $seconds = $_POST['seconds'];

        if($minutes < 0){
            $minutes = 0;
        }
        if($minutes > 59){
            $minutes = 59;
        }

        if($seconds < 0){
            $seconds = 0;
        }
        if($seconds > 59){
            $seconds = 59;
        }

        $song_duration = ($minutes*60)+$seconds;

        date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para São Paulo 
        // Isso previne que a criação de playlist cadastre a data errada de criação
        $date = date('Y-m-d');

        $ext = pathinfo ($_FILES['song']['name'], PATHINFO_EXTENSION);
        $ext = strtolower ($ext);

        if($ext == 'mp3'){
            $music_route = md5($song_name).$date.'.'.$ext;
            $directory = "../assets/audio/";
        }
        else{
            header('location: ../error_2.html');
        }

        $c = new connection();
        $conn = $c->connect();

        $m = new music();
        $m->setIdAlbum($album_id);
        $m->setName($song_name);
        $m->setMusicRoute($music_route);
        $m->setDuration($song_duration);

        $insert_m = new music_DAO();
        $result_m = $insert_m->insert_music($m, $conn);

        $uploadfile = $directory.$music_route;
        move_uploaded_file($_FILES['song'.$i]['tmp_name'], $uploadfile);

        if($result_m == true){
            header('location: ../album_info_art.php?id='.$album_id);
        }
        else{
            header('location: ../error_2.html');
        }
    }
    else{
       header('location: ../error_2.html');
    }
