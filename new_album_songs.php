<?php
    session_start();
    if(isset($_SESSION['id'])&& $_SESSION['type'] != 0){
        $activate_nav = 4;
    }
    else{
        header('location: error.html');
    }
    if(isset($_POST['a_name'], $_POST['artistic_name'], $_POST['category'], $_POST['song_qtt'], $_FILES['image'])){
        $name = $_POST['a_name'];
        $category = $_POST['category'];
        $song_quantity = $_POST['song_qtt'];
        $art_name = $_POST['artistic_name'];

        if($song_quantity > 30){
            $song_quantity = 30;
        }
        if($song_quantity <= 0){
            $song_quantity = 1;
        }

        $extension = strtolower(substr($_FILES['image']['name'], -4));

        if($extension == '.png' OR $extension == '.jpg' OR $extension == '.jpeg' OR $extension == '.gif'){
            $new_name = md5($_SESSION['id']).'.gif';
            $directory = "assets/images/temp_album_images/";
            move_uploaded_file($_FILES['image']['tmp_name'], $directory.$new_name);

            $full_directory = '../'.$directory.$new_name;
        }
        else{
            header('location: error_2.html');
        }
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

        <title>GMusic | Álbum</title>

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
                <h3 class="card-title mb-0">Novo Álbum</h3>
            </div>
            <div class="card-body">
                <form action="pdo/album-confirm.php" method="post" enctype="multipart/form-data">
                    <?php
                        $i = 0;
                        while($i != $song_quantity)
                        {
                    ?>
                            <div class="form-row form-group">
                                <label for="name<?=$i+1?>" class="col-md-4 text-md-right col-form-label">Nome da música <?=$i+1?></label>
                                <div class="col-md-7">
                                    <input type="text" name="name<?=$i+1?>" class="form-control" required>
                                </div>
                            </div>
                            <label for="duration" style="margin-bottom: 10px;" 
                            class="col-md-8 text-md-right col-form-label">Duração da música <?=$i+1?></label>
                            <div class="form-row form-group">
                                <label for="minutes" class="col-md-4 text-md-right col-form-label">Minutos</label>
                                <div class="col-md-3">
                                    <input type="number" name="minutes<?=$i+1?>" min="0" max="59" class="form-control" 
                                    placeholder="max. 59" required>
                                </div>
                                <label for="seconds" class="col-md-1 text-md-right col-form-label">Segundos</label>
                                <div class="col-md-3">
                                    <input type="number" name="seconds<?=$i+1?>" min="0" max="59" class="form-control" 
                                    placeholder="max. 59" required>
                                </div>
                            </div>
                            <div class="form-row form-group">
                                <label for="image-file" class="col-md-4 text-md-right col-form-label">Música <?=$i+1?> (.mp3)</label>
                                <div class="col-md-7">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="song<?=$i+1?>" required>
                                        <label class="custom-file-label" for="song">Escolher Arquivo</label>
                                    </div>
                            </div>
                            </div>
                            <hr style="width: 120%;">
                    <?php
                        $i++;
                        }
                    ?>
                    <input type="hidden" name="image_directory" value="<?=$full_directory?>" required>
                    <input type="hidden" name="a_name" class="form-control" value="<?=$name?>" required>
                    <input type="hidden" name="category" class="form-control" value="<?=$category?>" required>
                    <input type="hidden" name="song_qtt" class="form-control" value="<?=$song_quantity?>" required>
                    <input type="hidden" name="artistic_name" class="form-control" value="<?=$art_name?>" required>
                <div class="card-footer">
                <div class="row">
                        <input type="submit" value="Publicar Álbum" class="btn btn-brand btn-air">
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