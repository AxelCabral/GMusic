<?php
    session_start();
    if(isset($_SESSION['id'])&& $_SESSION['id'] != ""){
        if($_SESSION['type'] == 1){
            header('location:index_art.php');
        }
    }
?>
<div class="banner bg-home"></div>
<div class="main-container" id="appRoute">
    <div class="section row-flex-box">
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=1" id='category'>
                        <img src="assets/images/category_images/sertanejo.jpg" alt="Remix Songs" class="card-img--radius-md">
                        <span class="bg-blur">Sertanejo</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=2" id='category'>
                        <img src="assets/images/category_images/funk.jpg" alt="Rock Songs" class="card-img--radius-md">
                        <span class="bg-blur">Funk</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=3" id='category'>
                        <img src="assets/images/category_images/pop.jpg" alt="Sufi Songs" class="card-img--radius-md">
                        <span class="bg-blur">Pop</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=4" id='category'>
                        <img src="assets/images/category_images/samba.jpg" alt="Romantic Songs" class="card-img--radius-md">
                        <span class="bg-blur">Samba & Pagode</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=5" id='category'>
                        <img src="assets/images/category_images/rock.jpg" alt="Sports Songs" class="card-img--radius-md">
                        <span class="bg-blur">Rock</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=6" id='category'>
                        <img src="assets/images/category_images/trap.jpg" alt="Remix Songs" class="card-img--radius-md">
                        <span class="bg-blur">Trap</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=7" id='category'>
                        <img src="assets/images/category_images/hiphop.jpg" alt="Rock Songs" class="card-img--radius-md">
                        <span class="bg-blur">Hip Hop</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=8" id='category'>
                        <img src="assets/images/category_images/eletronica.jpg" alt="Sufi Songs" class="card-img--radius-md">
                        <span class="bg-blur">Eletrônica</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=9" id='category'>
                        <img src="assets/images/category_images/mpb.jpg" alt="Romantic Songs" class="card-img--radius-md">
                        <span class="bg-blur">MPB</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=10" id='category'>
                        <img src="assets/images/category_images/lofi.jpg" alt="Sports Songs" class="card-img--radius-md">
                        <span class="bg-blur">Indie & Lo-fi</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=11" id='category'>
                        <img src="assets/images/category_images/jazz.jpg" alt="Old Songs" class="card-img--radius-lg">
                        <span class="bg-blur">Jazz</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=12" id='category'>
                        <img src="assets/images/category_images/kpop.jpg" alt="Remix Songs" class="card-img--radius-md">
                        <span class="bg-blur">K-Pop</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=13" id='category'>
                        <img src="assets/images/category_images/anime.jpg" alt="Rock Songs" class="card-img--radius-md">
                        <span class="bg-blur">Anime</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=14" id='category'>
                        <img src="assets/images/category_images/classica.jpg" alt="Sufi Songs" class="card-img--radius-md">
                        <span class="bg-blur">Clássica</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=15" id='category'>
                        <img src="assets/images/category_images/acustico.jpg" alt="Romantic Songs" class="card-img--radius-md">
                        <span class="bg-blur">Acústico</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 pb-4">
            <div class="custom-card">
                <div class="custom-card--img">
                    <a href="filter.php?id=16" id='category'>
                        <img src="assets/images/category_images/jogos.jpg" alt="Old Songs" class="card-img--radius-lg">
                        <span class="bg-blur">Jogos</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script>
    $(document).ready(function(){
        $("a").click(function(e){
            e.preventDefault();

            var a = $(this).attr('href');
            var b = $(this).attr('id');

            if(b == 'category'){
                $("#loading").css("display", "inherit");
                $("a").not(this).removeClass("active");
                $("#2").addClass("active");
                //Exibir a página de categoria específica
                $.ajax({
                    url: a,
                    success: function(data)
                    {
                        $("#loading").delay(150).fadeOut();
                        $(".insert").html(data);
                        $("title").html("GMusic | Categoria");
                    }
                });
            }
        });
    });
</script>