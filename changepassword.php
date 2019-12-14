<?php 
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: index.php");
    };
    ob_start();
    include('mysql_conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Useful Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/changepassword.css">

    <title>Change Password</title>
</head>
<body>
<div class="loginform">
    <div class="leftcolumn">
        <img src="img/logoedit.jpg" alt="">
    </div>
    <div class="rightcolumn">
        
        <?php
            if(isset($_POST['email'])){
                $email = $_POST['email'];
                
                function random_strings($length_of_string){
                    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
                    return substr(str_shuffle($str_result), 0, $length_of_string); 
                }
                $newpassword = random_strings(10).rand(12,98);

                $checksql = "SELECT * FROM workers WHERE email=?";
                $checkstmt = $connection->prepare($checksql);
                $checkstmt->execute([$email]);
                if($checkstmt->rowCount() < 1){
                    header("Location: changepassword.php?error=wrong_email");
                }else{
                    $subject = "Password Reset";
                    $txt = "Your new generated password is: ".$newpassword."\n Please login in and change your password";
                    $headers = "From: admin@btm.com";
                    if(mail($email,$subject,$txt,$headers)){
                        $sql = "UPDATE workers SET password=? WHERE email=?";
                        $stmt = $connection->prepare($sql);
                        $stmt->execute([$newpassword, $email]);
                        header("Location: login.php?success=password_changed");
                        
                    }else{
                        echo "Error sending email. Password not reset";
                    }
                }

                
                
            }
        ?>
            <form action="" method="POST">
            <label for="email">Email</label>
            <input id="email" type="text" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
    
            <button type="submit">Password Reset</button><br>
        </form>
    </div>
</div>




<!-- Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>