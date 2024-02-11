<?php
    session_start();
    if(empty($_SESSION['id'])){
        header('location: error.html');
    }
    $id = $_SESSION['id'];
?>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<div class="banner bg-my-artists"></div>
<div class="main-container" id="appRoute">
    <h3 class="page_title">Meus artistas</h3>
    <p>Veja aqui os últimos lançamentos dos artista que você segue!</p>
    <hr>
    <?php
        include_once ('pdo/connection.php');
        include_once ('pdo/DAO/album_DAO.php');

        $count = 0;
        $count2 = 0;

        $c = new connection();
        $conn = $c->connect();

        $select = new album_DAO();
        $stmt = $select->new_artists_albums_list($conn, $id);

        if($stmt == null){
            echo "
            <div class='albums'>
                <div class='album'>
                    <h4 class='album_name'>Sem resultados</h4>
                </div>
            </div>
            ";
        }
        else{
            echo "<div class='albums'>";
            foreach($stmt as $list){
                    echo "<div class='album' id='principal-image",$list->id,"'>
                            <a href='album.php?id=",$list->id,"' id='album_link'>
                            <img src='assets/images/album_images/",$list->rota_foto,"' alt='album' class='principal-image'>
                            <img src='assets/images/play.png' alt='play' class='play-button' id='show_p",$list->id,"'></a>
                            <h4 class='album_name'><a href='album.php?id=",$list->id,"' id='album_link'>",$list->nome,"</a></h4>
                            <h6 class='artist_name'><a href='artist.php?id=",$list->id_artista,"' id='artist_link'>",$list->nome_artista,"</a></h6>
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
                    if($count>1 && $count%5 == 0){
                        echo "</div>";
                        echo "<div class='albums'>";
                    }
            }
            echo "</div>";
        }
    ?>
</div>
<script>
    $(document).ready(function(){
         $("a").click(function(e){
            e.preventDefault();

            var a = $(this).attr('href');
            var b = $(this).attr('id');
            
            if(b == "album_link"){
                $("#loading").css("display", "inherit");
                $("a").not(this).removeClass("active");
                $("#3").addClass("active");
            // Exibir a página de álbum individual
                $.ajax({
                    url: a,
                    success: function(data)
                    {
                        $("#loading").delay(150).fadeOut();
                        $(".insert").html(data);
                        $("title").html("GMusic | Álbum");
                    }
                });
            }
            if(b == "artist_link"){
                $("#loading").css("display", "inherit");
                $("a").not(this).removeClass("active");
                $("#3").addClass("active");
            // Exibir a página de artista individual
                $.ajax({
                    url: a,
                    success: function(data)
                    {
                        $("#loading").delay(150).fadeOut();
                        $(".insert").html(data);
                        $("title").html("GMusic | Artista");
                    }
                });
            }
         });
    });
</script>