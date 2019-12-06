<?php 
    include("../mysql_conn.php");
    if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['department']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['department'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $department = $_POST['department'];
    
        $emailsql = "SELECT * FROM workers WHERE email = :email";
        $emailstmt = $connection->prepare($emailsql);
        $emailstmt->execute(['email' => $email]);
        if($emailstmt->rowCount() > 0){
            echo "email taken";
            header('Location: ../users.php?error=email_exists');
        } else {

            $usernamesql = "SELECT * FROM workers WHERE username = :username";
            $usernamestmt = $connection->prepare($usernamesql);
            $usernamestmt->execute(['username' => $username]);
            if($usernamestmt->rowCount() > 0){
                echo "Username taken";
                header('Location: ../users.php?error=username_exists');
            }else{
                $sql = 'INSERT INTO workers(username, email, department, password) VALUES(:username, :email, :department, :password)';
                $stmt = $connection->prepare($sql);
                $stmt->execute(['username' => $username, 'email' => $email, 'department' => $department,'password' => "Password1"]);
                echo "User Added";
                header('Location: ../users.php?success=user_added');
        
            }
        }
    }else{
        header('Location: ../users.php?error=incomplete_form');
    }
?>
