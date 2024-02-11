<?php
    session_start();
    if(isset($_SESSION['id'])&& $_SESSION['type'] != 0){
        $activate_nav = 4;
    }
    else{
        header('location: error.html');
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
                <form action="new_album_songs.php" method="post" enctype="multipart/form-data">
                    <div class="form-row form-group">
                        <label for="a_name" class="col-md-4 text-md-right col-form-label">Nome do álbum</label>
                        <div class="col-md-7">
                            <input type="text" name="a_name" class="form-control" placeholder="Nome do novo álbum" required>
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <label for="artistic_name" class="col-md-4 text-md-right col-form-label">Nome Artístico</label>
                        <div class="col-md-7">
                            <input type="text" name="artistic_name" class="form-control" placeholder="Seu nome artístico" required>
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <label for="category" class="col-md-4 text-md-right col-form-label">Categoria</label>
                        <div class="col-md-7">
                            <select name="category" id="category" class="form-control" required>
                                <option value="Sertanejo">Sertanejo</option>
                                <option value="Funk">Funk</option>
                                <option value="Pop">Pop</option>
                                <option value="Samba">Samba</option>
                                <option value="Pagode">Pagode</option>
                                <option value="Rock">Rock</option>
                                <option value="Trap">Trap</option>
                                <option value="Hip Hop">Hip Hop / Rap</option>
                                <option value="Eletrônica">Eletrônica</option>
                                <option value="MPB">MPB</option>
                                <option value="Indie">Indie</option>
                                <option value="Lo-fi">Lo-fi</option>
                                <option value="Jazz">Jazz</option>
                                <option value="Kpp">K-pop</option>
                                <option value="Anime">Anime</option>
                                <option value="Clássica">Clássica</option>
                                <option value="Acústico">Acústico</option>
                                <option value="Jogos">Jogos</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <label for="image-file" class="col-md-4 text-md-right col-form-label">Capa do álbum</label>
                        <div class="col-md-7">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" required>
                                <label class="custom-file-label" for="image">Escolher Arquivo</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <label for="song_qtt" class="col-md-4 text-md-right col-form-label">Número de músicas</label>
                        <div class="col-md-7">
                            <input type="number" name="song_qtt" class="form-control" placeholder="máx. 30 músicas" required>
                        </div>
                    </div>
                <div class="card-footer">
                <div class="row">
                        <input type="submit" value="Continuar" class="btn btn-brand btn-air">
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