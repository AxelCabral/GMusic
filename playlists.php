<?php
    session_start();
    if(isset($_SESSION['id'])&& $_SESSION['type'] != 1){
        $user_id = $_SESSION['id'];
    }
    else{
        header('location: error.html');
    }
?>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<div class="banner bg-login"></div>
<div class="main-container" id="appRoute">
    <h3 class="page_title">Minhas Playlists</h3>
    <p>Organiza suas playlists aqui!</p>
    <hr>
    <div class='albums'>
        <div class='album'>
            <a href='new_playlist.php' id='new-pl'>
                <img src='assets/images/playlist_images/generic_album.png' alt='album'>
            </a>
            <h4 class='album_name'>
                <a href='new_playlist.php' id='new-pl'>Nova Playlist</a>
            </h4>
        </div>
    <?php
        include_once ('pdo/connection.php');
        include_once ('pdo/DAO/playlist_DAO.php');

        $list_space = 1;

        $c = new connection();
        $conn = $c->connect();

        $select = new playlist_DAO();
        $stmt = $select->my_playlist_list($conn, $user_id);

        foreach($stmt as $list){
            echo "<div class='album' id='principal-image",$list->id,"'>
                <a href='playlist_info.php?id=",$list->id,"' id='pl_link'>
                <img src='assets/images/playlist_images/",$list->rota_foto,"' alt='album' class='principal-image'>
                <img src='assets/images/play.png' alt='play' class='play-button' id='show_p",$list->id,"'></a>
                <h4 class='album_name'><a href='playlist_info.php?id=",$list->id,"' id='pl_link'>",$list->nome,"</a></h4>
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
            if($list_space > 1 && $list_space % 5 == 0){
                echo "</div>";
                echo "<div class='albums'>";
            }
        }
        echo "</div>";
    ?>
</div>
<script>
    $(document).ready(function(){
         $("a").click(function(e){
            e.preventDefault();

            var a = $(this).attr('href');
            var b = $(this).attr('id');
            
            if(b == "new-pl"){
                $("#loading").css("display", "inherit");
            //Exibir o formulário de nova playlist
                $.ajax({
                    url: a,
                    success: function(data)
                    {
                        $("#loading").delay(150).fadeOut();
                        $(".insert").html(data);
                        $("title").html("GMusic | Nova Playlist");
                    }
                });
            }
            if(b == "pl_link"){
                $("#loading").css("display", "inherit");
            // Exibir a página de uma playlist individual
                $.ajax({
                    url: a,
                    success: function(data)
                    {
                        $("#loading").delay(150).fadeOut();
                        $(".insert").html(data);
                        $("title").html("GMusic | Playlist");
                    }
                });
            }
         });
    });
</script>