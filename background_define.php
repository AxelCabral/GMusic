<?php
    function background_define($id){
        if($id == 1){
            $route = 'sertanejo.jpg';
        }
        else if($id == 2){
            $route = 'funk.jpg';
        }
        else if($id == 3){
            $route = 'pop.jpg';
        }
        else if($id == 4){
            $route = 'samba.jpg';
        }
        else if($id == 5){
            $route = 'rock.jpg';
        }
        else if($id == 6){
            $route = 'trap.jpg';
        }
        else if($id == 7){
            $route = 'hiphop.jpg';
        }
        else if($id == 8){
            $route = 'eletronica.jpg';
        }
        else if($id == 9){
            $route = 'mpb.jpg';
        }
        else if($id == 10){
            $route = 'lofi.jpg';
        }
        else if($id == 11){
            $route = 'jazz.jpg';
        }
        else if($id == 12){
            $route = 'kpop.jpg';
        }
        else if($id == 13){
            $route = 'anime.jpg';
        }
        else if($id == 14){
            $route = 'classica.jpg';
        }
        else if($id == 15){
            $route = 'acustico.jpg';
        }
        else if($id == 16){
            $route = 'jogos.jpg';
        }
        else{
            $route = 'search.jpg';
        }
        return $route;
    }
    function name_define($id){
        if($id == 1){
            $name = 'Sertanejo';
        }
        else if($id == 2){
            $name = 'Funk';
        }
        else if($id == 3){
            $name = 'Pop';
        }
        else if($id == 4){
            $name = 'Samba & Pagode';
        }
        else if($id == 5){
            $name = 'Rock';
        }
        else if($id == 6){
            $name = 'Trap';
        }
        else if($id == 7){
            $name = 'HipHop';
        }
        else if($id == 8){
            $name = 'Eletrônica';
        }
        else if($id == 9){
            $name = 'Mpb';
        }
        else if($id == 10){
            $name = 'Indie & Lofi';
        }
        else if($id == 11){
            $name = 'Jazz';
        }
        else if($id == 12){
            $name = 'Kpp';
        }
        else if($id == 13){
            $name = 'Anime';
        }
        else if($id == 14){
            $name = 'Clássica';
        }
        else if($id == 15){
            $name = 'Acústico';
        }
        else if($id == 16){
            $name = 'Jogos';
        }
        else{
            $name = 'Resultados';
        }
        return $name;
    }
