<?php
    include_once ('pdo/connection.php');
    include_once ('pdo/DAO/album_DAO.php');
    include_once ('pdo/DAO/music_DAO.php');
    include_once ('song_duration.php');

    session_start();
    
    $album_id = $_GET['id'];

    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    }
    else{
        $user_id = 'undefined';
    }

    if(isset($user_id)){

        include_once ('pdo/DAO/playlist_DAO.php');

        $c = new connection();
        $conn = $c->connect();

        $p = new playlist_DAO();
        $pop = $p->playlist_list($conn, $user_id);
    }
    $c = new connection();
    $conn = $c->connect();

    $select = new album_DAO();
    $stmt = $select->album_info($conn, $album_id);

    $select2 = new music_DAO();
    $stmt2 = $select2->album_songs_list($conn, $album_id);

    foreach($stmt as $info){
        $album_name = $info->nome;
        $artist_name = $info->nome_artista;
        $image_route = $info->rota_foto;
        $album_date = $info->data;
    }

?>
<div class="banner bg-home"></div>
<div class="main-container" id="appRoute">

<h1><?= $album_name ?></h1><strong>by <?= $artist_name ?></strong>
<p class="album_date">Lançado em <?= date('d/m/Y', strtotime($album_date)) ?></p>
<div class="col-12"><hr></div>
    
<div class="section custom-list">
    <?php
        $i = 0;
        foreach($stmt2 as $list){

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
                    <img style='min-height: 40px;' id='songImage",$list->id,"' src='assets/images/album_images/",$image_route,"' alt='Album Image' 
                    class='card-img--radius-sm'>
                </div>

                <div class='custom-card--inline-desc'>
                    <p class='songItem' class='text-truncate mb-0' id='",$list->id,"'>",$list->nome,"</p>
                </div>

                <input type='hidden' id='artistName",$list->id,"' value='",$artist_name,"'>
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
    </main>
</div>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
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

                    var link = 'album.php?id='+<?=$album_id?>;
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

                var link = 'album.php?id='+<?=$album_id?>;
                reload(link);
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