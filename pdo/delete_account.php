<?php
    include_once ("connection.php");
    include_once ("DAO/user_DAO.php");

    session_start();
    $id = $_SESSION['id'];

    $c = new connection();
    $conn = $c->connect();

    $u = new user_DAO();
    $u->delete_account($conn, $id);

    header("location:../logout.php");
