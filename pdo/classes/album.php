<?php
    class album{
        private $id;
        private $id_artist;
        private $artist_name;
        private $cover_route;
        private $category;
        private $date;
        private $name;

        //--------------Getters-----------------------------------
        function getId(){
            return $this->id;
        }
        function getIdArtist(){
            return $this->id_artist;
        }
        function getArtistName(){
            return $this->artist_name;
        }
        function getCoverRoute(){
            return $this->cover_route;
        }
        function getCategory(){
            return $this->category;
        }
        function getDate(){
            return $this->date;
        }
        function getName(){
            return $this->name;
        }
        //------------------Setters-------------------------------------
        function setId($id){
            $this->id = $id;
        }
        function setIdArtist($id_artist){
            $this->id_artist = $id_artist;
        }
        function setArtistName($artist_name){
            $this->artist_name = $artist_name;
        }
        function setCoverRoute($cover_route){
            $this->cover_route = $cover_route;
        }
        function setCategory($category){
            $this->category = $category;
        }
        function setDate($date){
            $this->date = $date;
        }
        function setName($name){
            $this->name = $name;
        }
    }
