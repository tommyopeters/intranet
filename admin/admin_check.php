<?php
    ob_start();
    session_start();
    include('mysql_conn.php');
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
        header('Location: ../login.php');
    }
    $adminsql = "SELECT * FROM admins WHERE email = :email";
    $adminstmt = $connection->prepare($adminsql);
    $adminstmt->execute(['email' => $_SESSION['email']]);
    if($adminstmt->rowCount() < 1){
        header('Location: ../index.php');
    };
?>