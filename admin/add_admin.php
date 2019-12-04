<?php 
    include("mysql_conn.php");
    if(isset($_POST['id']) && !empty($_POST['id'])) {
        $email = $_POST['email'];
    
        $emailsql = "SELECT * FROM admins WHERE email = :email";
        $emailstmt = $connection->prepare($emailsql);
        $emailstmt->execute(['email' => $email]);
        if($emailstmt->rowCount() > 0){
            echo "Already admin";
        } else {

            
                $sql = 'INSERT INTO admin(email, password) VALUES(:email, :password)';
                $stmt = $connection->prepare($sql);
                $stmt->execute(['username' => $username, 'password' => "Password1"]);
                echo "Admin Added";
        }
    }   
?>
