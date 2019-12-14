<?php 
    include("../mysql_conn.php");
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        
        $checksql = "SELECT * FROM workers WHERE id = :id";
        $checkstmt = $connection->prepare($checksql);
        $checkstmt->execute(['id' => $id]);
        if($checkstmt->rowCount() < 1){
        }else{
            $user = $checkstmt->fetch();

            $adminChecksql = "SELECT * FROM admins WHERE email = :email";
            $adminCheckstmt = $connection->prepare($adminChecksql);
            $adminCheckstmt->execute(['email' => $user['email']]);
            if($adminCheckstmt->rowCount() < 1){
            }else{
                    $adminsql = 'DELETE FROM admins where email = :email';
                    $adminstmt = $connection->prepare($adminsql);
                    $adminstmt->execute(['email' => $user['email']]);
            }

            $sql = 'DELETE FROM workers where id = :id';
            $stmt = $connection->prepare($sql);
            $stmt->execute(['id' => $id]);
            header("Location: ../users.php?success=user_deleted");


        }

        
    }   
?>
