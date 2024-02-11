<body class="theme-dark">
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
        <aside id="sidebar" class="sidebar-primary">

            <div class="sidebar-header d-flex align-items-center">
                <a href="index.php" class="brand">
                    <img src="assets/images/logo.svg" alt="listen-app">
                </a>
            </div>
            <nav class="navbar">
                <ul class="navbar-nav" data-scrollable="true">
                    <li class="nav-item nav-header">Menu</li>
                    <?php
                    include_once ('nav_definition.php');

                    echo "<li class='nav-item'>
                        <a href='index_art.php' class='",$nav_1,"'><i class='la la-home'></i><span>Home</span></a>
                    </li>
                    <li class='nav-item'>
                        <a href='artistic_profile.php' class='",$nav_2,"'><i class='la la-microphone'></i><span>Perfil de Artista</span></a>
                    </li>
                    <li class='nav-item'>
                        <a href='analytics.php' class='",$nav_3,"'><i class='la la-bar-chart'></i><span>Analytics</span></a>
                    </li>
                    <li class='nav-item'>
                        <a href='new_album.php' class='",$nav_4,"'><i class='la la-music'></i><span>Novo Álbum</span></a>
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