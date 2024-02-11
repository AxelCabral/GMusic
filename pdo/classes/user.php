<?php
    class user{
        private $id;
        private $name;
        private $email;
        private $icon;
        private $password;
        private $type;

        //--------------Getters-----------------------------------
        function getId(){
            return $this->id;
        }
        function getName(){
            return $this->name;
        }
        function getEmail(){
            return $this->email;
        }
        function getIcon(){
            return $this->icon;
        }
        function getPassword(){
            return $this->password;
        }
        function getType(){
            return $this->type;
        }
        //------------------Setters-------------------------------------
        function setId($id){
            $this->id = $id;
        }
        function setName($name){
            $this->name = $name;
        }
        function setEmail($email){
            $this->email = $email;
        }
        function setIcon($icon){
            $this->icon = $icon;
        }
        function setPassword($password){
            $this->password = $password;
        }
        function setType($type){
            $this->type = $type;
        }
    }
