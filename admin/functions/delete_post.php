<?php 
    include("../mysql_conn.php");
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        
        $checksql = "SELECT * FROM posts WHERE id = :id";
        $checkstmt = $connection->prepare($checksql);
        $checkstmt->execute(['id' => $id]);
        if($checkstmt->rowCount() < 1){
            echo "Fatal error";
            header("Location: ../blog.php?error=fatal");
        }else{
                $sql = 'DELETE FROM posts where id = :id';
                $stmt = $connection->prepare($sql);
                $stmt->execute(['id' => $id]);
                echo "Post Deleted";
                header("Location: ../blog.php?success=post_deleted");
        }

        
    }   
?>
