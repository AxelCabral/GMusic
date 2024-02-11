<?php
    session_start();
    if(isset($_SESSION['type'])&& $_SESSION['type'] == 1){
        $name = $_SESSION['name'];
        $activate_nav = 0;

        $user_id = $_SESSION['id'];

        include_once ('pdo/DAO/user_DAO.php');
        include_once ('pdo/connection.php');

        $c = new connection();
        $conn = $c->connect();

        $select = new user_DAO();
        $stmt = $select->my_profile_info($conn, $user_id);

        foreach($stmt as $info){
            $name = $info->nome;
            $email = $info->email;
            $password = 'senhaencriptada';
            $alternative_password = $info->senha;
            $icon = $info->icone;
        }
    }
    else{
        header('location: error_2.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br" style="background-color: white;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="GMusic App - Online Music Streaming App">
        <meta name="keywords" content="music template, music app, music web app, responsive music app, music, gmusic, musicg">

        <title id='tt'>GMusic | Perfil</title>

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
    <body>
    <div id="loading">
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
        <aside id="sidebar" class="sidebar-primary" style="background-color: #222629;">

            <div class="sidebar-header d-flex align-items-center">
                <a href="index.php" class="brand">
                    <img src="assets/images/logo.svg" alt="listen-app">
                </a>
            </div>
            <nav class="navbar">
                <ul class="navbar-nav" data-scrollable="true">
                    <li class="nav-item nav-header" style="color: white;">Menu</li>
                    <?php
                    include_once ('nav_definition.php');

                    echo "<li class='nav-item'>
                        <a href='index_art.php' class='",$nav_1,"'><i class='la la-home-white'></i><span class='span-color-profile'>Home</span></a>
                    </li>
                    <li class='nav-item'>
                        <a href='artistic_profile.php' class='",$nav_2,"'><i class='la la-microphone-white'></i><span class='span-color-profile'>Perfil de Artista</span></a>
                    </li>
                    <li class='nav-item'>
                        <a href='analytics.php' class='",$nav_3,"'><i class='la la-bar-chart-white'></i><span class='span-color-profile'>Analytics</span></a>
                    </li>
                    <li class='nav-item'>
                        <a href='new_album.php' class='",$nav_4,"'><i class='la la-music-white'></i><span class='span-color-profile'>Novo Álbum</span></a>
                    </li>";
                    ?>
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
                    <form action="#" id="searchForm">
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
                                echo "<a href='login.php' class='d-flex align-items-center py-2'>
                                <div class='avatar avatar-sm avatar-circle'><img src='assets/images/user-icon.png' alt='user'></div>
                                <span class='pl-2'>Fazer Login</span>
                                </a>";
                            } 
                        ?>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
                                <a class="dropdown-item" href="art_profile.php"><i class="ion-md-contact"></i><span>Perfil</span></a>
                                <a class="dropdown-item" href="configs.php"><i class="ion-md-settings"></i><span>Configurações</span></a>
                                <div class="dropdown-divider"></div>
                                <div class="px-4 py-2">
                                    <a href="logout.php" class="btn btn-sm btn-air btn-pill btn-danger">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
            </header>
                <div class="banner bg-profile" id="profile-banner"></div>

    <div class="main-container under-banner-content" id="appRoute">
    <div class="row-flex-box section">
        <div class="col-xl-10 mx-auto" style="margin-top: -150px;">
            <div class="row-flex-box">
                <div class="col-xl-4 col-md-5">
                    <div class="card h-auto">
                        <div class="card-body-profile text-center">
                            <form action="pdo/change_image.php" method="post" enctype="multipart/form-data">
                                <input style='display: none;' type='file' id='profile-image' name='profile-image' required>
                                    <div class="avatar avatar-xl avatar-circle mx-auto mb-4">
                                    <label for="profile-image" title="Trocar Imagem" style="cursor: pointer;">
                                        <img src='assets/images/user_images/<?=$_SESSION['icon']?>' alt="user">
                                    </label>
                                    </div>
                                <h6 class="mb-3">Hello <?=$_SESSION['name']?></h6>
                                <p class="mb-1">Preferred by: 420x420(px)</p>
                                <p>Minimum: 128x128(px)</p>
                                <input type="hidden" name="email" value="<?=$email?>">
                                <button type="submit" class="btn btn-danger btn-air">Trocar Imagem</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-7">
                    <div class="card h-auto">
                        <div class="card-body-profile">
                            <form action="pdo/edit_profile.php" method="post" class="row-flex-box" style="padding: 10%;">
                            <h5 class='profile-title'>Informações pessoais</h5>
                                <div class="col-12 form-group">
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="text" name="name" class="form-control" value="<?=$name?>" required>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="mail" name="email" class="form-control" value="<?=$email?>" required>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="password" class="form-label">Senha</label>
                                    <input type="password" name="password" class="form-control" value="<?=$password?>" required>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="alt_pass" value="<?=$alternative_password?>" required>
                                    <button type="submit" class="btn btn-primary btn-air">Alterar Informações</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="plan-info-card text-center px-sm-5 py-sm-4 p-3">
                        <h6>Excluir conta</h6>
                        <p>Desejo excluir minha conta, pois a GMusic não atendeu as minhas expectativas.</p>
                        <a href="pdo/delete_account.php" class="btn btn-pill btn-success">Excluir conta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <?php include_once('footer.php')?>
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