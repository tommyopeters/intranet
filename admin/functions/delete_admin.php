<?php 
    include("../mysql_conn.php");
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        
        $checksql = "SELECT * FROM admins WHERE id = :id";
        $checkstmt = $connection->prepare($checksql);
        $checkstmt->execute(['id' => $id]);
        if($checkstmt->rowCount() < 1){
            echo "Fatal error";
        }else{
                $sql = 'DELETE FROM admins where id = :id';
                $stmt = $connection->prepare($sql);
                $stmt->execute(['id' => $id]);
                echo "Admin Deleted";
                // header("Location: admin.php?success=admin_deleted)
        }

        
    }   
?>
