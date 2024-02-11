<?php
    include_once ('pdo/connection.php');
    include_once ('pdo/DAO/music_DAO.php');
    include_once ('pdo/DAO/album_DAO.php');
    include_once ('pdo/DAO/user_DAO.php');
    include_once ('song_duration.php');

    session_start();

    $artist_id = $_GET['id'];

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

    if(isset($_SESSION['id'])){

        $user_id = $_SESSION['id'];

        include_once ('pdo/DAO/playlist_DAO.php');

        $c = new connection();
        $conn = $c->connect();

        $p = new playlist_DAO();
        $pop = $p->playlist_list($conn, $user_id);
    }
?>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
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
                    <p><i class="la la-music" aria-hidden="true"></i> <?=$album_qtd?> Álbums publicados  |  <i class="la la-users" aria-hidden="true"></i> <?=$followers?> Seguidores</p>
                    <div class="mt-4">
                        <?php
                            if($follow_confirm == true){
                                echo "<a href='pdo/unfollow.php?id=",$artist_id,"' class='btn btn-pill btn-air btn-bold btn-danger'><span>Deixar de Seguir</span></a>";
                            }
                            else{
                                echo "<a href='pdo/follow.php?id=",$artist_id,"' class='btn btn-pill btn-air btn-bold btn-danger'><span>Seguir</span></a>";
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
                                    <img style='min-height: 40px;' id='songImage",$list->id,"' src='assets/images/album_images/",$list->rota_foto,"' alt='Album Image' 
                                    class='card-img--radius-sm'>
                                </div>

                                <div class='custom-card--inline-desc'>
                                    <p class='songItem' class='text-truncate mb-0' id='",$list->id,"'>",$list->nome,"</p>
                                </div>

                                <input type='hidden' id='artistName",$list->id,"' value='",$a_name,"'>
                                <input type='hidden' id='songFile",$list->id,"' value='",$list->rota_musica,"'>
                            </div>
                            <ul class='custom-card--labels d-flex ml-auto'>";
                                if($confirmation == true){
                                    echo "<li><span class='badge badge-pill badge-danger'><i class='la la-heart'></i></span></li>";
                                }
                            echo"<li>",$duration,"</li>
                                <li class='dropleft'>
                                    <a href='javascript:void(0);' class='btn btn-icon-only p-0 w-auto h-auto' data-toggle='dropdown' 
                                    aria-haspopup='true' aria-expanded='false'>
                                        <i class='la la-ellipsis-h'></i>
                                    </a>";
                                    if($confirmation == true){
                                        echo "<ul class='dropdown-menu'>
                                            <li class='dropdown-item'>
                                                <a href='#' class='dropdown-link-2 favorite' id='",$music_id,"'>
                                                <i class='la la-heart-o'></i>
                                                <span>Remove Favorite</span>
                                            </a>
                                        </li>";
                                    }
                                    else{
                                        echo "<ul class='dropdown-menu'>
                                            <li class='dropdown-item'>
                                                <a href='#' class='dropdown-link-2 favorite' id='",$music_id,"'>
                                                <i class='la la-heart-o'></i>
                                                <span>Favorite</span>
                                            </a>
                                            </li>";
                                    }
                                    echo"
                                        <li class='dropdown-item'>
                                        <a href='javascript:void(0);' class='dropdown-link-2' class='btn-open-modal' data-toggle='modal' data-target='#popup-modal",$i,"'>
                                            <i class='la la-plus'></i>
                                            <span>Add to Playlist</span>
                                        </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <hr style='margin-bottom: 7px; margin-top: 7px;'>
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
                                <form class='playlist-option' action='#' method='post' id='",$music_id,"'>
                                    <select name='playlist_id' id='select",$music_id,"'>
                                    <option value='null'></option>";
                                    foreach($pop as $list){
                                        $name = $list->nome;
                                        $value = $list->id;
                                        echo "<option value='",$value,"'>",$name,"</option>";
                                    }
                                echo"
                                    </select>
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
                                            <a href='album.php?id=",$list->id,"' id='album_link'>
                                            <img src='assets/images/album_images/",$list->rota_foto,"' alt='album' class='principal-image'>
                                            <img src='assets/images/play.png' alt='play' class='play-button' id='show_p",$list->id,"'></a>
                                            <h4 class='album_name'><a href='album.php?id=",$list->id,"' id='album_link'>",$list->nome,"</a></h4>
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
                                            <a href='album.php?id=",$list->id,"' id='album_link'>
                                            <img src='assets/images/album_images/",$list->rota_foto,"' alt='album' class='principal-image'>
                                            <img src='assets/images/play.png' alt='play' class='play-button' id='show_p",($list->id+15),"'></a></a>
                                            <h4 class='album_name'><a href='album.php?id=",$list->id,"' id='album_link'>",$list->nome,"</a></h4>
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
<script>
    $(document).ready(function(){
        $("a").click(function(e){
            e.preventDefault();

            var a = $(this).find("span").text();
            var b = $(this).attr("id");
            var c = $(".pl-2").text();

            if(a == "Favorite"){
                if(c != 'Fazer Login'){
                    //Favorita a música
                    $.get('pdo/favorite_item.php',
                    { 
                        music_id: b
                    });

                    var link = 'artist.php?id='+<?=$artist_id?>;
                    reload(link);
                }
                else{
                    alert('Você precisa estar logado para acessar essa função.');
                }
            }
            if(a == "Remove Favorite"){
                //Desfavorita a música
                $.get('pdo/remove_favorite_item.php',
                { 
                    music_id: b
                });

                var link = 'artist.php?id='+<?=$artist_id?>;
                reload(link);
            }
            if(a == "Seguir"){
                if(c != 'Fazer Login'){
                    //Seguir o artista
                    var artId = <?=$artist_id?>;
                    $.get('pdo/follow.php',
                    { 
                        artist_id: artId
                    });

                    var link = 'artist.php?id='+<?=$artist_id?>;
                    reload(link);
                }
                else{
                    alert('Você precisa estar logado para acessar essa função.');
                }
            }
            if(a == "Deixar de Seguir"){
                if(c != 'Fazer Login'){
                    //Seguir o artista
                    var artId = <?=$artist_id?>;
                    $.get('pdo/unfollow.php',
                    { 
                        artist_id: artId
                    });

                    var link = 'artist.php?id='+<?=$artist_id?>;
                    reload(link);
                }
                else{
                    alert('Você precisa estar logado para acessar essa função.');
                }
            }
            if(b == "album_link"){
                $("#loading").css("display", "inherit");
                $("a").not(this).removeClass("active");
                $("#1").addClass("active");

                var link = $(this).attr('href');
            // Exibir a página de álbum individual
                $.ajax({
                    url: link,
                    success: function(data)
                    {
                        $("#loading").delay(150).fadeOut();
                        $(".insert").html(data);
                        $("title").html("GMusic | Álbum");
                    }
                });
            }
        });
        $(".playlist-option").submit(function(e){
            e.preventDefault();

           var a = $(this).attr("id");
           var b = $("#select"+a).children("option:selected").val();
           var c = $(".pl-2").text();
           var d = $("#select"+a).children("option:selected").text();
           
            if(c != 'Fazer Login'){
                //Adiciona a música em uma playlist
                $.get('pdo/add_playlist_item.php',
                { 
                    music_id: a,
                    playlist_id: b
                });
                
                alert('Música adicionada á playlist '+d+ ' feche as opções, ou adicione a música á outras playlists.');

            }
            else{
                alert('Você precisa estar logado para acessar essa função.');
            }
        });
        $(".songItem").click(function(){
            var songId = $(this).attr('id');
            var songName = $(this).text();
            var artistName = $("#artistName"+songId).val();
            var songImage = $("#songImage"+songId).attr('src');
            var songFile = $("#songFile"+songId).val();
            var newSong = "<div class='slick-slide' data-slick-index='1'><div><div class='song-item' data-cover='"+songImage+"' data-artist='"+artistName+"'><a href='assets/audio/"+songFile+"' id='song-info'>"+songName+"</a></div></div></div>";
            $(".slick-track").append(newSong);
            alert("Música adicionada á fila.");
        });
    });
    function reload(link){
        $.ajax({
            url: link,
            success: function(data)
            {
                $(".insert").html(data);
            }
        });
    }
</script>