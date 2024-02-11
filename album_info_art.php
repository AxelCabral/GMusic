<?php
    include_once ('pdo/connection.php');
    include_once ('pdo/DAO/album_DAO.php');
    include_once ('pdo/DAO/music_DAO.php');
    include_once ('song_duration.php');

    session_start();
    if(isset($_SESSION['id'])){
        $activate_nav = 1;
        $album_id = $_GET['id'];
    }
    else{
        header('location: error.html');
    }
    $c = new connection();
    $conn = $c->connect();

    $select = new album_DAO();
    $stmt = $select->album_info($conn, $album_id);

    $select2 = new music_DAO();
    $stmt2 = $select2->album_songs_list($conn, $album_id);

    foreach($stmt as $info){
        $album_name = $info->nome;
        $artist_name = $info->nome_artista;
        $image_route = $info->rota_foto;
        $album_date = $info->data;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="GMusic App - Online Music Streaming App">
        <meta name="keywords" content="music template, music app, music web app, responsive music app, music, gmusic, musicg">

        <title>GMusic | Álbum</title>

        <link href="assets/images/favicon.svg" rel="icon"/>

        <link href="css/vendors.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles_perso.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="slick.css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    </head>
        <div class="example3">
            <div class="playlist">
                <?php
                    foreach($stmt2 as $song){
                        echo"
                        <div class='song-item' data-cover='assets/images/album_images/",$image_route,"' data-artist='",$artist_name,"'>
                            <a href='assets/audio/",$song->rota_musica,"' id='song-info'>",$song->nome,"</a>
                        </div>
                        ";
                    }
                ?>
            </div>
        </div>
        <?php include_once('header_art.php') ?>
            <div class="banner bg-home"></div>

            <div class="main-container" id="appRoute">
            <h1><?= $album_name ?></h1><strong>by <?= $artist_name ?></strong>
            <p class="album_date">Lançado em <?= date('d/m/Y', strtotime($album_date)) ?></p>
            <div class="col-12"><hr></div>
            
            <div class="section custom-list">
            <?php
                $i = 0;
                foreach($stmt2 as $list){

                    $time = $list->duration;
                    $music_id = $list->id;

                    $duration = song_duration($time);

                    echo"
                    <div class='custom-list--item'>
                    <div class='text-dark custom-card--inline'>
                        <div class='custom-card--inline-img'>
                            <img style='min-height: 40px;' src='assets/images/album_images/",$image_route,"' alt='Album Image' 
                            class='card-img--radius-sm'>
                        </div>

                        <div class='custom-card--inline-desc'>
                            <p class='text-truncate mb-0' id='song-name",$i,"'>",$list->nome,"</p>
                        </div>
                    </div>
                    <ul class='custom-card--labels d-flex ml-auto'>
                        <li>",$duration,"</li>
                        <li>|<a href='pdo/delete_song.php?id=",$list->id,"&pb=",$list->id_album,"'><i class='la la-trash' aria-hidden='true'></i> Excluir</a></li>
                    </ul>
                </div>
                <hr style='margin-bottom: 7px;
                margin-top: 7px;'>";
                $i++;
                }
            ?>
            <a href="add_song.php?id=<?=$album_id?>" class="add-button">
            <i class='la la-plus' aria-hidden='true'></i> Adicionar Música</a>
                <?php include_once('footer.php') ?>
            </main>
        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                verifyActive();
                $('body').click(function(){
                    verifyActive();
                });
            });
            function verifyActive(){
                var z = 0;
                var x = $('.active #song-info').text();
                var y = 'provisory';

                $('.addText').remove();
                while(x != y){
                    y = $('#song-name'+z).text();
                    if(x == y){
                        $('#song-name'+z).append("<text class='addText' style='color: #4CAF50;'> | Reproduzindo... </text>");
                    }
                    z++;
                }
            }
        </script>
        <script src="js/vendors.bundle.js"></script>
        <script src="js/scripts.bundle.js"></script>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/musicplayer.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
        <script type="text/javascript" src="js/player-script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>