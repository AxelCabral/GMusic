<?php
    session_start();
    if(isset($_SESSION['id'])&& $_SESSION['id'] != ""){
        if($_SESSION['type'] == 0){
            header('location:index.php');
        }
    }
    $activate_nav = 1;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="GMusic App - Online Music Streaming App">
        <meta name="keywords" content="music template, music app, music web app, responsive music app, music, gmusic, musicg">

        <title>GMusic | Home</title>

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
        <?php include_once('header_art.php') ?>
                <div class="banner bg-home"></div>
                <div class="main-container" id="appRoute">
                <h3 class="page_title">Meus álbums!</h3>
                <p>Organize seus álbums aqui.</p>
                <hr>
                <?php
                    include_once ('pdo/connection.php');
                    include_once ('pdo/DAO/album_DAO.php');

                    $list_space = 0;

                    $c = new connection();
                    $conn = $c->connect();

                    $select = new album_DAO();
                    $stmt = $select->my_albums_list($conn, $_SESSION['id']);

                    if($stmt == null){
                        echo "
                        <div class='albums'>
                            <div class='album'>
                                <h4 class='album_name'>Sem resultados</h4>
                            </div>
                        </div>
                        ";
                    }
                    else{
                        echo "<div class='albums'>";
                        foreach($stmt as $list){
                                if($list_space > 1 && ($list_space-1) % 5 == 0){
                                    echo "</div>";
                                    echo "<div class='albums'>";
                                }
                                echo "<div class='artist_album' id='principal-image",$list->id,"'>
                                        <a href='album_info_art.php?id=",$list->id,"'>
                                        <img src='assets/images/album_images/",$list->rota_foto,"' alt='album' 
                                        class='principal-image'>
                                        <img src='assets/images/play.png' alt='play' class='play-button'
                                        id='show_p",$list->id,"'>
                                        <h4 class='album_name'>",$list->nome,"</h4>
                                        </a>
                                        <h6 class='artist-options'><a href='edit_album.php?id=",$list->id,"'>
                                        <i class='la la-pencil-square' aria-hidden='true'></i> Editar</a> |
                                        <a href='pdo/delete_album.php?id=",$list->id,"'>
                                        <i class='la la-trash' aria-hidden='true'></i> Excluir</a></h6>
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
                                $list_space++;
                        }
                        echo "</div>";
                    }
                ?>
                <?php include_once('footer.php') ?>
            </main>
        </div>
        <script src="js/vendors.bundle.js"></script>
        <script src="js/scripts.bundle.js"></script>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/musicplayer.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
        <script type="text/javascript" src="js/player-script.js"></script>
    </body>
</html>