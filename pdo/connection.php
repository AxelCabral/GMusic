<?php
class connection{
    
    protected $pdo;
    
    function connect(){
        $this->pdo = new PDO("mysql:host=localhost; dbname=gmusic", "root", "");
        return $this->pdo;
}
}
?>