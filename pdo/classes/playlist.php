<?php
    class playlist{
        private $id;
        private $name;
        private $date;
        private $cover_route;
        private $id_user;

        //----------------Getters--------------------------------------- 
        function getId(){
            return $this->id;
        }
        function getName(){
            return $this->name;
        }
        function getDate(){
            return $this->date;
        }
        function getCoverRoute(){
            return $this->cover_route;
        }
        function getIdUser(){
            return $this->id_user;
        }
        //------------------Setters-------------------------------------
        function setId($id){
            $this->id = $id;
        }
        function setName($name){
            $this->name = $name;
        }
        function setDate($date){
            $this->date = $date;
        }
        function setCoverRoute($cover_route){
            $this->cover_route = $cover_route;
        }
        function setIdUser($id_user){
            $this->id_user = $id_user;
        }
    }
