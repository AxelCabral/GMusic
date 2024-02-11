<?php
    session_start();
    if(isset($_SESSION['id'])&& $_SESSION['id'] != ""){
        if($_SESSION['type'] == 0){
            header ('location: error-type.html');
        }
    }
    else{
        header ('location: error.html');
    }
    $activate_nav = 3;

    include_once ('pdo/connection.php');
    include_once ('pdo/DAO/music_DAO.php');
    include_once ('pdo/DAO/album_DAO.php');
    include_once ('pdo/DAO/user_DAO.php');

    $count_in = 0;
    $months_1 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    $months_2 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    $months_3 = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    $album_per_year = 0;
    $song_per_year = 0;
    $follows_per_year = 0;

    date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para São Paulo 
    $year = date('Y');

    $c = new connection();
    $conn = $c->connect();

    $select = new music_DAO();
    $stmt = $select->my_songs($conn, $_SESSION['id']);

    $select = new album_DAO();
    $stmt2 = $select->my_albums_list($conn, $_SESSION['id']);

    $select = new user_DAO();
    $stmt3 = $select->artist_followers($conn, $_SESSION['id']);

    foreach($stmt as $count_in_play){
        $count_in += $count_in_play->add_playlist;
    }

    for($i = 0; $i < 12; $i++){
        foreach($stmt as $graphic_1){
            $year_dt = date('Y', strtotime($graphic_1->data));
            $month_dt = date('m', strtotime($graphic_1->data));

            if($year_dt == $year AND $month_dt == ($i+1)){
                $months_1[$i] += 1;
            }
        }
        $song_per_year += $months_1[$i];
    }

    for($i = 0; $i < 12; $i++){
        foreach($stmt2 as $graphic_2){
            $year_dt = date('Y', strtotime($graphic_2->data));
            $month_dt = date('m', strtotime($graphic_2->data));

            if($year_dt == $year AND $month_dt == ($i+1)){
                $months_2[$i] += 1;
            }
        }
        $album_per_year += $months_2[$i];
    }

    for($i = 0; $i < 12; $i++){
        foreach($stmt3 as $graphic_3){
            $year_dt = date('Y', strtotime($graphic_3->data));
            $month_dt = date('m', strtotime($graphic_3->data));

            if($year_dt == $year AND $month_dt == ($i+1)){
                $months_3[$i] += 1;
            }
        }
        $follows_per_year += $months_3[$i];
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

        <style>
            .card p, .card span, .card h6{
                padding-right: 2rem;
                padding-left: 2rem;
            }
            .align-items-center{
                align-items: center;
                margin-left: 50px !important;
            }
        </style>
    </head>
    <?php include_once('header_art.php') ?>
        <div class="banner bg-analytics"></div>
        <div class="main-container" id="appRoute">
    <div class="section">
        <div class="mb-5">
            <h5>Olá <span class="text-brand"><?=$_SESSION['name']?></span>, Bem-vindo á suas analytics da GMusic</h5>
            <p>Aqui você irá encontrar informações importantes sobre o rendimento de suas músicas no app.</p>
        </div>

        <div class="row-flex-box">
            <div class="col-xl-5">
                <div class="card bg-info text-white">
                    <div class="card-body-profile">
                        <div class="d-flex align-items-center">
                            <h6 class="text-white mb-0">Engajamento</h6>
                            <button type="button" class="btn btn-icon-only text-white ml-auto">
                                <i class="ion-md-settings"></i>
                            </button>
                        </div>
                        <p>O tempo todo os ouvintes criam playlists de músicas, suas músicas estão presentes em várias
                        delas.</p>
                        <span class="display-4 d-block mb-3"><?=$count_in?> músicas</span><p>presentes em playlists da GMusic.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-7">
                <div class="row-flex-box h-100">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body-profile">
                                <h6>Seguidores (<?=$year?>)</h6>
                                <div class="d-flex align-items-center">
                                    <i class="ion-md-people text-danger font-lg"></i>
                                    <p class="font-weight-bold pl-2"><?=$follows_per_year?></p>
                                    <?php
                                        for($i = 0; $i < 12; $i++){
                                            echo "<input type='hidden' value='",$months_3[$i],"' id='thiInf-",$i,"'>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <canvas id="user" style="height: 150px"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body-profile">
                                <h6>Músicas Novas (<?=$year?>)</h6>
                                <div class="d-flex align-items-center">
                                    <i class="ion-md-musical-note text-dark font-lg"></i>
                                    <p class="font-weight-bold pl-2" style="margin: 0;"><?=$song_per_year?></p>
                                    <?php
                                        for($i = 0; $i < 12; $i++){
                                            echo "<input type='hidden' value='",$months_1[$i],"' id='inf-",$i,"'>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <canvas id="songChart" style="height: 150px"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card bg-warning">
                            <div class="card-body-profile">
                                <h6>Álbums Novos (<?=$year?>)</h6>
                                <div class="d-flex align-items-center">
                                    <i class="ion-md-disc font-lg"></i>
                                    <p class="font-weight-bold pl-2"><?=$album_per_year?></p>
                                    <?php
                                        for($i = 0; $i < 12; $i++){
                                            echo "<input type='hidden' value='",$months_2[$i],"' id='secInf-",$i,"'>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <canvas id="purchase" style="height: 150px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-flex-box">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Estatísticas de novas músicas</h6>
                    </div>
                    <div class="card-body-profile">
                        <canvas id="userStatistics" style="height: 240px"></canvas>
                        <div class="text-center">
                            <span class="font-weight-bold d-block mt-3">Gráfico detalhado sobre as músicas
                            publicadas no ano de <?=$year?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header--flex">
                        <h6 class="mb-0">Dados numéricos</h6>
                    </div>
                    <div class="card-body-profile">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item border-0 p-0">
                                <p class="font-lg mb-2"><?=$count_in?></p>
                                <p>Músicas totais adicionadas á playlists</p>
                                <div class="progress mb-2" style="height: .25rem">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0 pb-0">
                                <p class="font-lg mb-2"><?=$follows_per_year?></p>
                                <p>Novos seguidores no ano de <?=$year?></p>
                                <div class="progress mb-2" style="height: .25rem">
                                    <div class="progress-bar bg-brand-analytics" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0 pb-0">
                                <p class="font-lg mb-2"><?=$song_per_year?></p>
                                <p>Músicas novas no ano de <?=$year?></p>
                                <div class="progress mb-2" style="height: .25rem">
                                    <div class="progress-bar bg-primary-analytics" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0 pb-0">
                                <p class="font-lg mb-2"><?=$album_per_year?></p>
                                <p>Álbums publicados no ano de <?=$year?></p>
                                <div class="progress mb-2" style="height: .25rem">
                                    <div class="progress-bar bg-secondary-analytics" role="progressbar" style="width: 109%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                        </ul>
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