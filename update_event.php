<?php
    include('mysql_conn.php');
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];


        $sql = "UPDATE events SET title = ?, start_event = ?, end_event = ? WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$title, $start, $end, $id]);
    }
?>