<?php 
    include("../mysql_conn.php");
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        
        $checksql = "SELECT * FROM department_posts WHERE id = :id";
        $checkstmt = $connection->prepare($checksql);
        $checkstmt->execute(['id' => $id]);
        if($checkstmt->rowCount() < 1){
            header("Location: ../posts.php?error=fatal");
        }else{
                $sql = 'DELETE FROM department_posts where id = :id';
                $stmt = $connection->prepare($sql);
                $stmt->execute(['id' => $id]);
                header("Location: ../posts.php?success=post_deleted");
        }

        
    }   
?>
