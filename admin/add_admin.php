<?php 
    include("mysql_conn.php");
    if(isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
    
        $emailsql = "SELECT * FROM admins WHERE email = :email";
        $emailstmt = $connection->prepare($emailsql);
        $emailstmt->execute(['email' => $email]);
        if($emailstmt->rowCount() > 0){
            echo "email taken";
        } else {

            
                $sql = 'INSERT INTO admin(email, password) VALUES(:email, :password)';
                $stmt = $connection->prepare($sql);
                $stmt->execute(['username' => $username, 'password' => "Password1"]);
                echo "Admin Added";
        }
    }   
?>
