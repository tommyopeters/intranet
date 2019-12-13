<?php
    if(isset($_POST['loggedin']) && isset($_POST['user_id']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['department']) && !empty($_POST['user_id']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['department'])){
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $_POST['user_id'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['department'] = $_POST['department'];
    }
?>