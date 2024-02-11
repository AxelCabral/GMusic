<?php
    include_once ('connection.php');
    include_once ('classes/album.php');
    include_once ('classes/music.php');
    include_once ('DAO/album_DAO.php');
    include_once ('DAO/music_DAO.php');

    if(isset($_POST['a_name'], $_POST['image_directory'], $_POST['category'], $_POST['song_qtt'], $_POST['artistic_name'])){

        $album_name = $_POST['a_name'];
        $image_directory = $_POST['image_directory'];
        $category = $_POST['category'];
        $art_name = $_POST['artistic_name'];
        $song_quantity = $_POST['song_qtt'];
        $i = 1;
        $var_validator = false;

        while($i <= $song_quantity){
            if(isset($_POST['name'.$i], $_POST['minutes'.$i], $_POST['seconds'.$i], $_FILES['song'.$i])){
                $var_validator = true;
            }
            else{
                header('../error_2.html');
            }
            $i++;
        }

        $new_name = md5(time()).'.gif';
        $directory = "../assets/images/album_images/";
        date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para São Paulo 
        // Isso previne que a criação de playlist cadastre a data errada de criação
        $date = date('Y-m-d');
        
        session_start();
        $artist_id = $_SESSION['id']; //Define o id do usuário que está criando a playlist

        $c = new connection();
        $conn = $c->connect();

        $a = new album();
        $a->setIdArtist($artist_id);
        $a->setArtistName($art_name);
        $a->setCoverRoute($new_name);
        $a->setCategory($category);
        $a->setDate($date);
        $a->setName($album_name);
        
        $insert_a = new album_DAO();
        $result_a = $insert_a->insert_album($a, $conn);

        rename($image_directory, $directory.$new_name);

        $album_id = $insert_a->select_id($artist_id, $art_name, $new_name, $album_name, $conn);

        $i = 1;
        while($i <= $song_quantity){
            
            $minutes = $_POST['minutes'.$i];

            if($minutes < 0){
                $minutes = 0;
            }
            if($minutes > 59){
                $minutes = 59;
            }

            $seconds = $_POST['seconds'.$i];

            if($seconds < 0){
                $seconds = 0;
            }
            if($seconds > 59){
                $seconds = 59;
            }

            $song_duration = ($minutes*60)+$seconds;

            $song_name = $_POST['name'.$i];

            $ext = pathinfo ($_FILES['song'.$i]['name'], PATHINFO_EXTENSION);
            $ext = strtolower ($ext);

            if($ext == 'mp3'){
                $music_route = md5($song_name).$date.'.'.$ext;
                $directory = "../assets/audio/";
            }
            else{
                header('location: ../error_2.html');
            }

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
                $i++;
            }
            else{
                header('location: ../error_2.html');
            }
        }
        if($result_a == true){
            header('location: ../index_art.php');
        }
        else{
            header('location: ../error_2.html');
        }

    }
    else{
       header('location: ../error_2.html');
    }
