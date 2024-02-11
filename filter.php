<?php
    session_start();
    if(isset($_GET['id'])){
        $filter_parm = false;
        $title = 'Categoria';
        $id = $_GET['id'];
    }
    else{
        $filter_parm = false;
        $title = 'Busca';
        $id = 0;
    }

    if(isset($_SESSION['option'])){
        $op = $_SESSION['option'];
        if($op == 1 OR $op == 2){
            $exibition = 'álbuns';
        }
        else if($op == 3){
            $exibition = 'músicas';
        }
        else{
            $exibition = 'álbuns';
        }
    }
    else{
        $exibition = 'álbuns';
        $op = 1;
    }
    include_once ('background_define.php');

    $bf = background_define($id);
    $name = name_define($id);

    echo "<style>
        .bg-event {
            background-image: url('assets/images/category_images/",$bf,"');
        }
        </style>";
?>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<div class="banner bg-event"></div>
<div class="main-container" id="appRoute">
    <h3 class="page_title"><?=$name?></h3>
    <p>Exibindo <?=$exibition?> relacionados á "<?php
        if($name == 'Resultados'){
            echo $_GET['search'];
        }else{
            echo $name;
        }
    ?></p>
    <hr>
    <?php
        include_once ('pdo/connection.php');
        include_once ('pdo/DAO/album_DAO.php');
        include_once ('pdo/DAO/music_DAO.php');

        $count = 0;
        $count2 = 0;

        $c = new connection();
        $conn = $c->connect();

        $select = new album_DAO();
        if($title == 'Categoria'){
            $stmt = $select->filter_albums_list($conn, $name);
        }
        else{
            if($op == 1){
                $stmt = $select->filter_albums_list_parm($conn, $_GET['search']);
            }
            else if($op == 2){
                $stmt = $select->filter_albums_list_parm_2($conn, $_GET['search']);
            }
            else{
                $select = new music_DAO();
                $stmt = $select->song_list_parm($conn, $_GET['search']);
            }
        }

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
                if($op != 3){
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
                    if($count > 1 && $count % 5 == 0){
                        echo "</div>";
                        echo "<div class='albums'>";
                    }
                }
                else{
                    echo "<div class='album' id='principal-image",$list->id,"'>
                            <a href='album.php?id=",$list->id_album,"' id='album_link'>
                            <img src='assets/images/album_images/",$list->rota_foto,"' alt='album' class='principal-image'>
                            <img src='assets/images/play.png' alt='play' class='play-button' id='show_p",$list->id,"'></a>
                            <h4 class='album_name'><a href='album.php?id=",$list->id_album,"' id='album_link'>",$list->nome,"</a></h4>
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
                    $count2++;
                    if($count2 > 1 && $count2 % 5 == 0){
                        echo "</div>";
                        echo "<div class='albums'>";
                    }
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
                $("#1").addClass("active");
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
                $("#1").addClass("active");
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