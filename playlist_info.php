<?php
    include_once ('pdo/connection.php');
    include_once ('pdo/DAO/playlist_DAO.php');
    include_once ('pdo/DAO/music_DAO.php');
    include_once ('pdo/DAO/album_DAO.php');
    include_once ('song_duration.php');
    
    session_start();
    if(isset($_SESSION['id'])&& $_SESSION['type'] != 1){
        $playlist_id = $_GET['id'];
        $user_id = $_SESSION['id'];
    }
    else{
        header('location: error.html');
    }

    if(isset($user_id)){
        $c = new connection();
        $conn = $c->connect();

        $p = new playlist_DAO();
        $pop = $p->playlist_list($conn, $user_id);
    }
?>
<div class="banner bg-home"></div>
<div class="main-container" id="appRoute">
    <?php
        $c = new connection();
        $conn = $c->connect();

        $select = new playlist_DAO();
        $stmt = $select->playlist_info($conn, $playlist_id);

        $select2 = new music_DAO();
        $stmt2 = $select2->playlist_songs_list($conn, $playlist_id);

        $count = 0;
        $time_count = 0;

        foreach($stmt as $info){
            $playlist_name = $info->nome;
            $user_name = $_SESSION['name'];
            $playlist_date = $info->data;
        }
        foreach($stmt2 as $list){
            $count++;
            $time_count = $time_count+$list->duration;
        }
        $duration = total_playlist_duration($time_count);
    ?>
    <h1><?= $playlist_name ?></h1>
    <div class='play-songs'>
        <img src="assets/images/play.png" title='Reproduzir playlist' alt="play-favorite-songs">
    </div>
    <p><strong>Contém <?= $count ?> Músicas</strong>, <?=$duration?></p>
    <p class="album_date" style="margin-top: -2em;"> Criada em <?= date('d/m/Y', strtotime($playlist_date)) ?></p>
    <div class="col-12"><hr></div>
    <div class="section custom-list">
        <?php
            $i = 0;
            $full_list = "";
            foreach($stmt2 as $list){

                $time = $list->duration;
                $music_id = $list->id;

                $duration = song_duration($time);

                $full_list = $full_list."<div class='slick-slide' data-slick-index='1'><div><div class='song-item' 
                data-cover='assets/images/album_images/".$list->rota_foto."' data-artist='".$list->nome_artista."'>
                <a href='assets/audio/".$list->rota_musica."' id='song-info'>".$list->nome."</a></div></div></div>";

                if(isset($_SESSION['id'])){
                    $fav_verification = new music_DAO();
                    $confirmation = $fav_verification->favorite_verification($conn, $music_id, $user_id);

                    $icon = new album_DAO();
                    $icon = $icon->get_icon($conn, $music_id);

                    foreach($icon as $get_icon){
                        $icon_route = $get_icon->rota_foto;
                    }   
                }
                else{
                    $confirmation = false;
                }
                echo"
                <div class='custom-list--item'>
                <div class='text-dark custom-card--inline'>
                    <div class='custom-card--inline-img'>
                        <img style='min-height: 40px;' id='songImage",$list->id,"' src='assets/images/album_images/",$icon_route,"' alt='Album Image' 
                        class='card-img--radius-sm'>
                    </div>

                    <div class='custom-card--inline-desc'>
                    <p class='songItem' class='text-truncate mb-0' id='",$list->id,"'>",$list->nome," - <a class='list-link' href='artist.php?
                    id=",$list->id_artista,"' id='artist_link'> ",$list->nome_artista,"</a></p>
                    </div>

                    <input type='hidden' id='artistName",$list->id,"' value='",$list->nome_artista,"'>
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
                            <li class='dropdown-item'>
                                <a href='#' class='dropdown-link-2' id='",$music_id,"'>
                                    <i class='la la-minus'></i>
                                    <span>Remove from playlist</span>
                                </a>
                            </li>
                        </ul>
                    </li>
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
                        <input type='submit' value='Adicionar à playlist'>
                    </form>
                    </div>
                    </div>
                </div>
                </div>";
                $i++;
            }
            echo "<div class='list'>",$full_list,"</div>";
        ?>
        <a href="pdo/delete_playlist.php?id=<?=$playlist_id?>" class="delete-button">
        <i class='la la-trash' aria-hidden='true'></i><span>Deletar Playlist</span></a>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script>
    $(document).ready(function(){
        $("a").click(function(e){
            e.preventDefault();

            var a = $(this).find("span").text();
            var b = $(this).attr("id");

            if(a == "Remove Favorite"){
                //Desfavorita a música
                $.get('pdo/remove_favorite_item.php',
                { 
                    music_id: b
                });

                var link = 'playlist_info.php?id='+<?=$playlist_id?>;
                reload(link);
            }
            if(a == "Favorite"){
                //Favorita a música
                $.get('pdo/favorite_item.php',
                { 
                    music_id: b
                });

                var link = 'playlist_info.php?id='+<?=$playlist_id?>;
                reload(link);
            }
            if(a == "Remove from playlist"){
                //Remove a música da playlist
                var plId = <?=$playlist_id?>;
                $.get('pdo/remove_playlist_item.php',
                { 
                    music_id: b,
                    playlist_id: plId
                });

                var link = 'playlist_info.php?id='+<?=$playlist_id?>;
                reload(link);
            }
            if(a == "Deletar Playlist"){
                //Deleta a playlist
                var plId = <?=$playlist_id?>;
                $.get('pdo/delete_playlist.php',
                {
                    playlist_id: plId
                });

                var link = 'playlists.php';
                reload(link);
                reload(link);
            }
            if(b == "artist_link"){
                $("#loading").css("display", "inherit");
                var link = $(this).attr('href');
            // Exibir a página do artista da música
                $.ajax({
                    url: link,
                    success: function(data)
                    {
                        $("#loading").delay(150).fadeOut();
                        $(".insert").html(data);
                        $("title").html("GMusic | Artista");
                    }
                });
            }
        });
        $(".songItem").click(function(){
            var songId = $(this).attr('id');
            var songName = $(this).text();
            songName = songName.split("-", 1);
            var artistName = $("#artistName"+songId).val();
            var songImage = $("#songImage"+songId).attr('src');
            var songFile = $("#songFile"+songId).val();
            var newSong = "<div class='slick-slide' data-slick-index='1'><div><div class='song-item' data-cover='"+songImage+"' data-artist='"+artistName+"'><a href='assets/audio/"+songFile+"' id='song-info'>"+songName+"</a></div></div></div>";
            $(".slick-track").append(newSong);
            alert("Música adicionada á fila.");
        });
        $(".play-songs").click(function(){
            $(".slick-track").empty();
            var fullList = $(".list").html();
            $(".slick-track").append(fullList);
            alert("Playlist inserida na fila.");
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