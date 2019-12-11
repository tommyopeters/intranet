<?php
    include('mysql_conn.php');

    $sql = "SELECT * FROM events";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    $data = array();

    foreach($results as $row){
        $data[] = array(
            'id' => $row["id"],
            'title' => $row["title"],
            'start' => $row["start_event"],
            'end' => $row["end_event"]
        );
    }

    echo json_encode($data);
?>