<?php 
    include("mysql_conn.php");
    session_start();
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $adminsql = "SELECT * FROM admins WHERE email = :email";
        $adminstmt = $connection->prepare($adminsql);
        $adminstmt->execute(['email' => $_SESSION['email']]);
        if($adminstmt->rowCount() < 1){
            header('Location: department.php');
        };
        
        $checksql = "SELECT * FROM uploads WHERE id = :id";
        $checkstmt = $connection->prepare($checksql);
        $checkstmt->execute(['id' => $id]);
        if($checkstmt->rowCount() < 1){
            echo "Fatal error";
            header("Location: department.php?error=fatal");
        }else{
                $sql = 'DELETE FROM uploads where id = :id';
                $stmt = $connection->prepare($sql);
                $stmt->execute(['id' => $id]);
                echo "Upload Deleted";
                header("Location: department.php");
        }

        
    }   
?>
