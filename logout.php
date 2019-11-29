<?php 
    session_start();
    $_SESSION['loggedin'] = false;
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['department']);
    $_SESSION = array();
    session_destroy();
    header("location:login.php")
?>
