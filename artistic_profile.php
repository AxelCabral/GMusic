<?php
    include_once ('pdo/connection.php');
    include_once ('pdo/DAO/music_DAO.php');
    include_once ('pdo/DAO/album_DAO.php');
    include_once ('pdo/DAO/user_DAO.php');
    include_once ('song_duration.php');

    session_start();

    $activate_nav = 2;

    $artist_id = $_SESSION['id'];

    $c = new connection();
    $conn = $c->connect();

    $select = new music_DAO();
    $stmt = $select->best_artist_songs($conn, $artist_id);

    $select = new album_DAO();
    $stmt2 = $select->last_artist_albums_list($conn, $artist_id);

    $select = new album_DAO();
    $stmt3 = $select->all_artist_albums_list($conn, $artist_id);

    $select = new user_DAO();
    $stmt4 = $select->artist_info($conn, $artist_id);

    $select = new user_DAO();
    $stmt5 = $select->artist_followers($conn, $artist_id);

    $album_qtd = 0;
    foreach($stmt3 as $album_info){
        $album_qtd++;
    }

    foreach($stmt4 as $art_info){
        $a_name = $art_info->nome;
        $a_icon = $art_info->icone;
    }

    $followers = 0;
    $follow_confirm = false;
    foreach($stmt5 as $follows){
        $followers++;
        if(isset($_SESSION['id'])){
            if($follows->id_artista == $artist_id AND $follows->id_ouvinte == $_SESSION['id']){
                $follow_confirm = true;
            }
        }
    }

    @$user_id = $_SESSION['id'];

    if(isset($user_id)){

        include_once ('pdo/DAO/playlist_DAO.php');

        $c = new connection();
        $conn = $c->connect();

        $p = new playlist_DAO();
        $pop = $p->playlist_list($conn, $user_id);
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

        <title>GMusic | Artista</title>

        <link href="assets/images/favicon.svg" rel="icon"/>

        <link href="css/vendors.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles_perso.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="slick.css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    </head>
    <div class="example3">
            <div class="playlist">
            <?php
                    foreach($stmt as $song){
                        echo"
                        <div class='song-item' data-cover='assets/images/album_images/",$song->rota_foto,"' data-artist='",$a_name,"'>
                            <a href='assets/audio/",$song->rota_musica,"' id='song-info'>",$song->nome,"</a>
                        </div>
                        ";
                        $i++;
                    }
                ?>
            </div>
    </div>
    <?php include_once('header_art.php') ?>
        <div class="banner bg-artists"></div>
            <div class="main-container" id="appRoute">
                <div class="row-flex-box text-center text-md-left" style="margin-bottom: 1rem;">
                    <div class="col-xl-3 col-lg-4 col-sm-5">
                        <img class='big-card-artist' src="assets/images/user_images/<?=$a_icon?>" alt="" class="card-img--radius-lg">
                    </div>
                    <div class="col-xl-9 col-lg-8 col-sm-7">
                        <div class="row-flex-box pt-4">
                            <div class="col-xl-8 col-lg-6">
                                <h5><?=$a_name?></h5>
                                <p><i class="la la-music" aria-hidden="true"></i></i> <?=$album_qtd?> Álbums publicados  |  <i class="la la-users" aria-hidden="true"></i> <?=$followers?> Seguidores</p>
                            <div class="mt-4">
                                <?php
                                    if($follow_confirm == true){
                                        echo "<a href='pdo/unfollow.php?id=",$artist_id,"' class='btn btn-pill btn-air btn-bold btn-danger'>
                                        Deixar de Seguir</a>";
                                    }
                                    else{
                                        echo "<a href='pdo/follow.php?id=",$artist_id,"' class='btn btn-pill btn-air btn-bold btn-danger'>
                                        Seguir</a>";
                                    }
                                ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <ul class="nav nav-tabs line-tabs line-tabs-primary text-uppercase mb-4" id="artistDetails" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="song-tab" data-toggle="tab" href="#song" role="tab" aria-controls="song" aria-selected="true">Melhores músicas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="album-tab" data-toggle="tab" href="#album" role="tab" aria-controls="album" aria-selected="false">Últimos lançamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bio-tab" data-toggle="tab" href="#bio" role="tab" aria-controls="bio" aria-selected="false">Todos os álbums</a>
                </li>
            </ul>
            <div class="tab-content" id="artistDetailsContent">
                <div class="tab-pane fade show active" id="song" role="tabpanel" aria-labelledby="song-tab">
                    <div class="row-flex-box align-items-end">
                        <span class="col-6 font-weight-bold">15 melhores músicas</span>
                        <div class="col-12"><hr></div>
                    </div>
                    <div class="custom-list">
            <?php
                $i = 0;
                foreach($stmt as $list){

                    $time = $list->duration;
                    $music_id = $list->id;

                    $duration = song_duration($time);

                    if(isset($_SESSION['id'])){
                        $fav_verification = new music_DAO();
                        $confirmation = $fav_verification->favorite_verification($conn, $music_id, $user_id);
                    }
                    else{
                        $confirmation = false;
                    }
                    echo"
                    <div class='custom-list--item'>
                    <div class='text-dark custom-card--inline'>
                        <div class='custom-card--inline-img'>
                            <img style='min-height: 40px;' src='assets/images/album_images/",$list->rota_foto,"' alt='Album Image' 
                            class='card-img--radius-sm'>
                        </div>

                        <div class='custom-card--inline-desc'>
                            <p class='text-truncate mb-0' id='song-name",$i,"'>",$list->nome,"</p>
                        </div>
                    </div>
                    <ul class='custom-card--labels d-flex ml-auto'>";
                        if($confirmation == true){
                            echo "<li><span class='badge badge-pill badge-danger'><i class='la la-heart'></i></span></li>";
                        }
                    echo"<li>",$duration,"</li>
                    </ul>
                </div>
                <hr style='margin-bottom: 7px;
                margin-top: 7px;'>
                <div class='modal fade' id='popup-modal",$i,"' tabindex='-1' role='dialog' aria-labelledby='popup-modalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document' id='modal-content-playlist'>
                        <div class='modal-content' id='modal-content-playlist-options'>
                        <div class='modal-header'>
                            <h6 style='margin-left: 8%;' class='modal-title' id='popup-modalLabel'>Selecione a playlist em que deseja adicionar:</h6>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'
                            id='btn-close-playlist-options'>
                            <span aria-hidden='true'><i class='la la-close'></i></span>
                            </button>
                        </div>
                        <div class='modal-body'>
                        <form action='pdo/add_playlist_item.php' method='post'>
                            <select name='playlist_id' id='pn'>
                            <option value='null'></option>";
                            foreach($pop as $list){
                                $name = $list->nome;
                                $value = $list->id;
                                echo "<option value='",$value,"'>",$name,"</option>";
                            }
                        echo"
                            </select>
                            <input type='hidden' name='music_id' value='",$music_id,"'>
                            <input type='hidden' name='pb' value='3'>
                            <input type='hidden' name='ac' value='",$artist_id,"'>
                            <input type='submit' value='Adicionar à playlist'>
                        </form>
                        </div>
                        </div>
                    </div>
                    </div>";
                $i++;
                }
            ?>
                    </div>
                </div>
                <div class="tab-pane fade show" id="album" role="tabpanel" aria-labelledby="album-tab">
                    <div class="row-flex-box align-items-end">
                        <span class="col-6 font-weight-bold">15 últimos álbums</span>
                        <div class="col-12"><hr></div>
                    </div>
                    <div class="custom-list">
                    <?php
                    $count = 0;
                    if($stmt2 == null){
                    ?>
                        <div class='albums'>
                            <div class='album'>
                                <h4 class='album_name'>Sem resultados</h4>
                            </div>
                        </div>
                    <?php
                    }
                    else{
                        echo "<div class='albums'>";
                        foreach($stmt2 as $list){
                                echo "<div class='album' id='principal-image",$list->id,"'>
                                        <a href='album_info_art.php?id=",$list->id,"'>
                                        <img src='assets/images/album_images/",$list->rota_foto,"' alt='album' class='principal-image'>
                                        <img src='assets/images/play.png' alt='play' class='play-button' id='show_p",$list->id,"'></a>
                                        <h4 class='album_name'><a href='album_info_art.php?id=",$list->id,"'>",$list->nome,"</a></h4>
                                    </div>
                                    <script>
                                        $(document).ready(function(){
                                            $('#show_p",$list->id,"').hide();
                                            $('.albums a').css('color', '#fff');
                                            $('#principal-image",$list->id,"').mouseenter(function(){
                                                $('#show_p",$list->id,"').show();
                                                $('#principal-image",$list->id," .principal-image').css('opacity', '0.5');
                                            });
                                            $('#principal-image",$list->id,"').mouseleave(function(){
                                                $('#show_p",$list->id,"').hide();
                                                $('#principal-image",$list->id," .principal-image').css('opacity', '1');
                                            });
                                        });
                                    </script>";
                                $count++;
                                if($count>1 && $count%5 == 0){
                                    echo "</div>";
                                    echo "<div class='albums'>";
                                }
                        }
                        echo "</div>";
                    }
                    ?>
                    </div>
                </div>
                <div class="tab-pane fade show" id="bio" role="tabpanel" aria-labelledby="bio-tab">
                <div class="row-flex-box align-items-end">
                        <span class="col-6 font-weight-bold">Todos os álbums</span>
                        <div class="col-12"><hr></div>
                    </div>
                    <div class="custom-list">
                    <?php
                    $count = 0;
                    if($stmt2 == null){
                    ?>
                        <div class='albums'>
                            <div class='album'>
                                <h4 class='album_name'>Sem resultados</h4>
                            </div>
                        </div>
                    <?php
                    }
                    else{
                        echo "<div class='albums'>";
                        foreach($stmt3 as $list){
                            echo "<div class='album' id='principal-image",($list->id+15),"'>
                                    <a href='album_info_art.php?id=",$list->id,"'><img src='assets/images/album_images/",$list->rota_foto,"' alt='album'
                                    class='principal-image'>
                                    <img src='assets/images/play.png' alt='play' class='play-button' id='show_p",($list->id+15),"'></a>
                                    <h4 class='album_name'><a href='album_info_art.php?id=",$list->id,"'>",$list->nome,"</a></h4>
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        $('#show_p",($list->id+15),"').hide();
                                        $('.albums a').css('color', '#fff');
                                        $('#principal-image",($list->id+15),"').mouseenter(function(){
                                            $('#show_p",($list->id+15),"').show();
                                            $('#principal-image",($list->id+15)," .principal-image').css('opacity', '0.5');
                                        });
                                        $('#principal-image",($list->id+15),"').mouseleave(function(){
                                            $('#show_p",($list->id+15),"').hide();
                                            $('#principal-image",($list->id+15)," .principal-image').css('opacity', '1');
                                        });
                                    });
                                </script>";
                            $count++;
                            if($count > 1 && $count % 5 == 0){
                                echo "</div>";
                                echo "<div class='albums'>";
                            }
                    }   
                        echo "</div>";
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('footer.php') ?>
    </main>
    </div>
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
    </body>
</html>