<?php
    session_start();
    if(isset($_GET['id'], $_SESSION['id'])&& $_SESSION['type'] != 0){
        $album_id = $_GET['id'];
        $activate_nav = 4;
    }
    else{
        header('location: error_2.html');
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

        <title>GMusic | Música</title>

        <link href="assets/images/favicon.svg" rel="icon"/>

        <link href="css/vendors.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles_perso.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="slick.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    </head>
        <?php include_once('header_art.php') ?>
        <div class="banner bg-login"></div>
        <div class="main-container" id="appRoute">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Nova Música</h3>
            </div>
            <div class="card-body">
                <form action="pdo/song-confirm.php" method="post" enctype="multipart/form-data">
                        <div class="form-row form-group">
                            <label for="name" class="col-md-4 text-md-right col-form-label">Nome da música</label>
                            <div class="col-md-7">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                    <label for="duration" style="margin-bottom: 10px;" 
                    class="col-md-8 text-md-right col-form-label">Duração da música</label>
                    <div class="form-row form-group">
                        <label for="minutes" class="col-md-4 text-md-right col-form-label">Minutos</label>
                        <div class="col-md-3">
                            <input type="number" name="minutes" min="0" max="59" class="form-control" 
                            placeholder="max. 59" required>
                        </div>
                        <label for="seconds" class="col-md-1 text-md-right col-form-label">Segundos</label>
                        <div class="col-md-3">
                            <input type="number" name="seconds" min="0" max="59" class="form-control" 
                            placeholder="max. 59" required>
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <label for="image-file" class="col-md-4 text-md-right col-form-label">Música (.mp3)</label>
                        <div class="col-md-7">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="song" required>
                                <label class="custom-file-label" for="song">Escolher Arquivo</label>
                            </div>
                    </div>
                    </div>
                <input type="hidden" name="album_id" value="<?=$album_id?>" required>
                <div class="card-footer">
                    <div class="row">
                            <input type="submit" value="Publicar Música" class="btn btn-brand btn-air">
                        </div>
                    </div>
                </form>
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