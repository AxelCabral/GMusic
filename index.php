<?php
    session_start();
    if(isset($_SESSION['name'])){
        $name = $_SESSION['name'];
    }
    else{
        $name = null;
    }
    if(isset($_SESSION['type'])&& $_SESSION['type'] == 1){
        header('location: index_art.php');
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

        <title id='tt'>GMusic | Home</title>

        <link href="assets/images/favicon.svg" rel="icon"/>

        <link href="css/vendors.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles_perso.css" rel="stylesheet" type="text/css"/>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="slick.css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    </head>
    <div class="example3">
        <div class="playlist">
        </div>
    </div>
    <div class='queue-cleaner' title='Limpar fila de músicas'>
        <img src="assets/images/trash.svg" alt="clean" id='queueCleaner'>
    </div>
    <body class="theme-dark">
        <div id="loading" style="background-color: rgb(185 184 184);">
            <div class="loader">
                <div class="eq">
                    <span class="eq-bar eq-bar--1"></span>
                    <span class="eq-bar eq-bar--2"></span>
                    <span class="eq-bar eq-bar--3"></span>
                    <span class="eq-bar eq-bar--4"></span>
                    <span class="eq-bar eq-bar--5"></span>
                    <span class="eq-bar eq-bar--6"></span>
                </div>
                <span style="color: black !important;" class="text">Loading...</span>
            </div>
        </div>
        <div id="wrapper" data-scrollable="true">
            
            <aside id="sidebar" class="sidebar-primary">
                <div class="sidebar-header d-flex align-items-center">
                    <a href="index.php" id='logo' class="brand">
                        <img src="assets/images/logo.svg" alt="gmusic">
                    </a>
                </div>
                <nav class="navbar">
                    <ul class="navbar-nav" data-scrollable="true">
                        <li class="nav-item nav-header">Menu</li>
                        <li class='nav-item'>
                                <a href='#' class='nav-link' id='1'><i class='la la-home' id='i1'></i><span>Home</span></a>
                            </li>
                            <li class='nav-item'>
                                <a href='#' class='nav-link' id='2'><i class='la la-diamond' id='i2'></i><span>Categorias</span></a>
                            </li>
                            <li class='nav-item'>
                                <a href='#' class='nav-link' id='3'><i class='la la-microphone' id='i3'></i><span>Meus Artistas</span></a>
                            </li>
                            <li class='nav-item'>
                                <a href='#' class='nav-link' id='4'><i class='la la-bar-chart' id='i4'></i><span>Analytics</span></a>
                            </li>
                            <li class='nav-item'>
                                <a href='#' class='nav-link' id='5'><i class='la la-heart-o' id='i5'></i><span>Favoritos</span></a>
                            </li>
                            <li class='nav-item'>
                                <a href='#' class='nav-link' id='6'><i class='la la-bullseye' id='i6'></i><span>Playlists</span></a>
                            </li>
                    </ul>
                </nav>
            </aside>
            <main id="pageWrapper">
                <header id="header" class="bg-primary">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn toggle-menu mr-3" id="openSidebar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <form action="#" method="get" id="searchForm">
                            <button type="button" class="btn ion-ios-search"></button>
                            <input type="text" name="search" placeholder="Search..." id="searchInput" class="form-control">
                        </form>
                        <ul class="header-options d-flex align-items-center">
                            <li class="dropdown fade-in">
                                <?php 
                                    if(isset($_SESSION['id'])&& $_SESSION['id'] != ""){
                                        echo "<a href='javascript:void(0);' class='d-flex align-items-center py-2' 
                                            role='button' id='userMenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <div class='avatar avatar-sm avatar-circle'><img src='assets/images/user_images/",$_SESSION['icon'],"' alt='user'>
                                            </div>
                                            <span class='pl-2'>",$_SESSION['name'],"</span>
                                            </a>";
                                    }
                                    else{
                                        echo "<a href='#' class='d-flex align-items-center py-2'>
                                        <div class='avatar avatar-sm avatar-circle'><img src='assets/images/user-icon.png' alt='user'></div>
                                        <span class='pl-2'>Fazer Login</span>
                                        </a>";
                                    } 
                                ?>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
                                    <a class="dropdown-item" href="profile.php"><i class="ion-md-contact"></i><span>Perfil</span></a>
                                    <a class="dropdown-item" href="configs.php"><i class="ion-md-settings"></i><span>Configurações</span></a>
                                    <div class="dropdown-divider"></div>
                                    <div class="px-4 py-2">
                                        <a href="logout.php" class="btn btn-sm btn-air btn-pill btn-danger">
                                        <span>Logout</span></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                </header>
                <div class="insert"></div>
                <footer>
                    <hr>
                    <h6 class="footer-text">© 2020 Copyright GMusic</h6><p>by Axel Cabral</p>
                </footer>
            </main>
            </div>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script>
            $(document).ready(function(){
                //Exibe a página inicial
                $("#loading").css("display", "inherit");
                $("a").not(this).removeClass("active");
                $("#1").addClass("active");
                $.ajax({
                    url: 'home_page.php',
                    success: function(data)
                    {
                        $("#loading").delay(250).fadeOut();
                        $(".insert").html(data);
                    }
                });

                $("a").click(function(e){
                    e.preventDefault();

                    var a = $(this).find("span").text();
                    var num = $(this).attr('id');
                    var stl = $('title').text();
    
                    verifyCss(a, stl);

                    if(a == "Home"){
                        $("#loading").css("display", "inherit");
                        $("a").not(this).removeClass("active");
                        $("#1").addClass("active");
                    // Exibir a página inicial
                        $.ajax({
                            url: 'home_page.php',
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $(".insert").html(data);
                                $("title").html("GMusic | Home");
                            }
                        });
                    }
                    if(a == "Categorias"){
                        $("#loading").css("display", "inherit");
                        $("a").not(this).removeClass("active");
                        $("#2").addClass("active");
                    // Exibir página de categorias
                        $.ajax({
                            url: 'categorias.php',
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $(".insert").html(data);
                                $("title").html("GMusic | Categorias");
                            }
                        });
                    }
                    if(a == "Meus Artistas"){
                        $("#loading").css("display", "inherit");
                        $("a").not(this).removeClass("active");
                        $("#3").addClass("active");
                    // Exibir página dos artistas seguidos pelo usuário
                        $.ajax({
                            url: 'my_artists.php',
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $(".insert").html(data);
                                $("title").html("GMusic | Meus Artistas");
                            }
                        });
                    }
                    if(a == "Fazer Login"){
                        $("#loading").css("display", "inherit");
                        $("a").not(this).removeClass("active");
                        $("#1").addClass("active");
                    // Exibir página de Login
                        $.ajax({
                            url: 'login.php',
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $(".insert").html(data);
                                $("title").html("GMusic | Login");
                            }
                        });
                    }
                    if(a == "Analytics"){
                        $("#loading").css("display", "inherit");
                        $("a").not(this).removeClass("active");
                        $("#4").addClass("active");
                    // Exibir página de Analytics
                        $.ajax({
                            url: 'analytics.php',
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $(".insert").html(data);
                                $("title").html("GMusic | Analytics");
                            }
                        });
                    }
                    if(a == "Favoritos"){
                        $("#loading").css("display", "inherit");
                        $("a").not(this).removeClass("active");
                        $("#5").addClass("active");
                    // Exibir página de Favoritos
                        $.ajax({
                            url: 'favorite.php',
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $(".insert").html(data);
                                $("title").html("GMusic | Favoritos");
                            }
                        });
                    }
                    if(a == "Playlists"){
                        $("#loading").css("display", "inherit");
                        $("a").not(this).removeClass("active");
                        $("#6").addClass("active");
                    // Exibir página de Playlists
                        $.ajax({
                            url: 'playlists.php',
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $(".insert").html(data);
                                $("title").html("GMusic | Playlist");
                            }
                        });
                    }
                    if(a == "Perfil"){
                        $("#loading").css("display", "inherit");
                        $("a").not(this).removeClass("active");
                    // Exibir página de Perfil
                        $.ajax({
                            url: 'profile.php',
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $(".insert").html(data);
                                $("title").html("GMusic | Perfil");
                            }
                        });
                    }
                    if(a == "Configurações"){
                        $("#loading").css("display", "inherit");
                        $("a").not(this).removeClass("active");
                    // Exibir página de Configurações
                        $.ajax({
                            url: 'configs.php',
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $(".insert").html(data);
                                $("title").html("GMusic | Configurações");
                            }
                        });
                    }
                    if(a == "Logout"){
                        $("#loading").css("display", "inherit");
                        $("a").not(this).removeClass("active");
                    // Deslogar da conta
                        $.ajax({
                            url: 'logout.php',
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $(".insert").html(data);
                                $("title").html("GMusic | Logout");
                            }
                        });
                    }
                    if(num == "logo"){
                        $("#loading").css("display", "inherit");
                        $("a").not(this).removeClass("active");
                        $("#1").addClass("active");
                    //Exibir a página inicial (utilizando o link da logo)
                        $.ajax({
                            url: 'home_page.php',
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $(".insert").html(data);
                                $("title").html("GMusic | Home");
                            }
                        });
                    }
                });
                $("form").submit(function(e){
                    e.preventDefault();

                    var a = $("#searchInput").val();

                    verifyCss(a, a);

                    $("#loading").css("display", "inherit");
                    $("a").not(this).removeClass("active");
                    $("#1").addClass("active");
                    //Exibir resultados da busca
                    $.ajax({
                            url: 'filter.php?search='+a,
                            success: function(data)
                            {
                                $("#loading").delay(150).fadeOut();
                                $("#searchInput").val("");
                                $(".insert").html(data);
                                $("title").html("GMusic | Busca");
                            }
                        });
                });
                $("#queueCleaner").click(function(){
                    $(".slick-track").empty();
                    alert("A fila de músicas foi limpa!");
                });
                function verifyCss(a, b){
                    if(a == 'Perfil' || a == '<?=$name?>' && b == 'GMusic | Perfil'){
                        $("html").css("background-color", "white");
                        $(".nav-header").css("color", "#fff");
                        $("aside").css("background-color", "#222629");
                        $("body").removeClass("theme-dark");
                        $(".nav-link span").addClass("span-color-profile");
                        $("#i1").attr('class', 'la la-home-white');
                        $("#i2").attr('class', 'la la-diamond-white');
                        $("#i3").attr('class', 'la la-microphone-white');
                        $("#i4").attr('class', 'la la-bar-chart-white');
                        $("#i5").attr('class', 'la la-heart-o-white');
                        $("#i6").attr('class', 'la la-bullseye-white');  
                        $(".btn-sucess").attr('background-color', 'transparent');
                    }
                    else{
                        $("html").css("background-color", "#343a40");
                        $("nav-item nav-header").css("color:", "#dee2e6");
                        $("body").addClass("theme-dark");
                        $("span").removeClass("span-color-profile");
                        $("#i1").attr('class', 'la la-home');
                        $("#i2").attr('class', 'la la-diamond');
                        $("#i3").attr('class', 'la la-microphone');
                        $("#i4").attr('class', 'la la-bar-chart');
                        $("#i5").attr('class', 'la la-heart-o');
                        $("#i6").attr('class', 'la la-bullseye');
                    }
                }
            });
        </script>
        <script src="js/vendors.bundle.js"></script>
        <script src="js/scripts.bundle.js"></script>
        <script type="text/javascript" src="js/musicplayer.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
        <script type="text/javascript" src="js/player-script.js"></script>
    </body>
</html>