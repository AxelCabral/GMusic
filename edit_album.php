<?php
    session_start();
    if(isset($_SESSION['id'])&& $_SESSION['type'] != 0){
        $activate_nav = 1;
    }
    else{
        header('location: error.html');
    }

    $id = $_GET['id'];

    include_once ('pdo/DAO/album_DAO.php');
    include_once ('pdo/connection.php');

    $c = new connection();
    $conn = $c->connect();

    $select = new album_DAO();
    $stmt = $select->my_album_info($conn, $id);

    foreach($stmt as $info){
        $a_name = $info->nome_artista;
        $name = $info->nome;
        $image = $info->rota_foto;
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
        <div class="banner bg-profile" id="profile-banner"></div>

            <div class="main-container under-banner-content" id="appRoute">

            <div class="row-flex-box section">
                <div class="col-xl-10 mx-auto" style="margin-top: -150px;">
                    <div class="row-flex-box">
                        <div class="col-xl-4 col-md-5">
                            <div class="card h-auto">
                                <div class="card-body-profile text-center" style="height: 25rem;">
                                    <form action="pdo/change_album_image.php" method="post" enctype="multipart/form-data">
                                        <input style='display: none;' type='file' id='album-image' name='album-image' required>
                                            <div class="avatar avatar-xl avatar-square mx-auto mb-6" style="width: 15rem; height: 15rem;
                                            margin-bottom: 1rem; margin-top: 1rem;">
                                            <label for="album-image" title="Trocar Imagem" style="cursor: pointer;">
                                                <img style="width: 100%; height: 240px;" src='assets/images/album_images/<?=$image?>' alt="user">
                                            </label>
                                            </div>
                                        <h6 class="mb-3">Clique na imagem para escolher a nova imagem.</h6>
                                        <input type="hidden" name="id" value="<?=$id?>">
                                        <input type="hidden" name="route" value="<?=$image?>">
                                        <button type="submit" class="btn btn-danger btn-air">Trocar Imagem</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-md-7">
                            <div class="card h-auto">
                                <div class="card-body-profile">
                                    <form action="pdo/edit_album_info.php" method="post" class="row-flex-box" style="padding: 10%;">
                                    <h5 class='profile-title'>Informações do álbum</h5>
                                        <div class="col-12 form-group">
                                            <label for="name" class="form-label">Nome</label>
                                            <input type="text" name="name" class="form-control" value="<?=$name?>" required>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="a_name" class="form-label">Nome Artístico</label>
                                            <input type="text" name="a_name" class="form-control" value="<?=$a_name?>" required>
                                        </div>
                                        <div class="col-12" style="text-align: center; margin-top: 15px;">
                                            <input type="hidden" name="id" value="<?=$id?>">
                                            <button type="submit" class="btn btn-primary btn-air">Alterar Informações</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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