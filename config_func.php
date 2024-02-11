<?php
    session_start();

    $config = strip_tags($_POST['config']);
    
    if(isset($config)){
        $_SESSION['option'] = $config;
    }
