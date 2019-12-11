<?php
    include('mysql_conn.php');
    if(isset($_POST['id'])){
        $id = $_POST['id'];


        $sql = "DELETE FROM events WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$id]);
    }
?>