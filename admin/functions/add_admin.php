<?php 
    include("../mysql_conn.php");
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        
        $usersql = "SELECT * FROM workers WHERE id = :id";
        $userstmt = $connection->prepare($usersql);
        $userstmt->execute(['id' => $id]);
        if($userstmt->rowCount() < 1){
            header("Location: ../users.php?error=fatal");
        }else{
            $user = $userstmt->fetch();
            $username = $user['username'];
            $email = $user['email'];

            $emailsql = "SELECT * FROM admins WHERE email = :email";
            $emailstmt = $connection->prepare($emailsql);
            $emailstmt->execute(['email' => $email]);
            if($emailstmt->rowCount() > 0){
                header("Location: ../users.php?error=admin_exists");
            } else {

                $sql = 'INSERT INTO admins (username, email) VALUES (:username, :email)';
                $stmt = $connection->prepare($sql);
                $stmt->execute(['username' => $username, 'email' => $email]);
                header("Location: ../users.php?success=admin_added");
            }
        }

        
    }   
?>
