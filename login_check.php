
<?php 
    ob_start();
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
        header('Location: login.php');
    }
    include('mysql_conn.php');
?>