<?php
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

        <title>GMusic | Cadastro</title>

        <link href="assets/images/favicon.svg" rel="icon"/>

        <link href="css/styles_perso.css" rel="stylesheet" type="text/css"/>
        <link href="css/vendors.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="slick.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    </head>
        <div class="example3">
            <div class="playlist">
            <div class="song-item" data-cover="assets/images/album_images/doka.jpg" data-artist="Sidoka">
                <a href="data/doka.mp3">Replay</a>
            </div>
        </div>
        <?php include_once('header.php') ?>
        <div class="banner bg-login"></div>
        <div class="main-container" id="appRoute">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Cadastro</h3>
            </div>
            <div class="card-body">
                <div class="message">
                    <?php 
                    if(isset($_GET['msg'])&& $_GET['msg'] != ""){
                        echo $_GET['msg'];
                    }
                    else{
                        echo "Ops! ocorreu um erro, tente novamente.";
                    }
                    ?>
                    <p></p>
                    <a class="back-link" href="register.php">Voltar ao cadastro.</a>
                </div>
            </div>
        </div>
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