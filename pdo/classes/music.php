<?php
    class music{
        private $id;
        private $id_album;
        private $name;
        private $music_route;
        private $duration;

        //----------------Getters--------------------------------------- 
        function getId(){
            return $this->id;
        }
        function getIdAlbum(){
            return $this->id_album;
        }
        function getName(){
            return $this->name;
        }
        function getMusicRoute(){
            return $this->music_route;
        }
        function getDuration(){
            return $this->duration;
        }
        //------------------Setters-------------------------------------
        function setId($id){
            $this->id = $id;
        }
        function setIdAlbum($id_album){
            $this->id_album = $id_album;
        }
        function setName($name){
            $this->name = $name;
        }
        function setMusicRoute($music_route){
            $this->music_route = $music_route;
        }
        function setDuration($duration){
            $this->duration = $duration;
        }
    }
