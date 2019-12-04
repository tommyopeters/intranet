<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Useful Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">

    <title>LOGIN</title>
</head>
<body>
<div class="loginform">
    <div class="leftcolumn">
        <img src="img/logoedit.jpg" alt="">
    </div>
    <?php
    include('mysql_conn.php');
    if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM workers WHERE email = :email";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['email' => $email]);
        if($stmt->rowCount() < 1){
            echo "<p class='text-danger'>Wrong Email</p>";
        } else {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data['password'] == $password){
            session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $data['id'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['department'] = $data['department'];
            header('Location: ./index.php');
        } else{
            echo "<p class='text-danger'>Wrong password</p>";
        }
        }
    }
    
    //$sql = 'INSERT INTO auth(username, email, department, password) VALUES(:username, :email, :department, :password)';
    
    //$stmt = $connection->prepare($sql);
    //$stmt->execute(['username' => $username, 'email' => $email, 'department' => $department,'password' => $password]);
    //echo "Post Added";
    //}
    


    //$sql = 'INSERT INTO auth(username, email, department, password) VALUES(:username, :email, :department, :password)';

    //$stmt = $connection->prepare($sql);
    //$stmt->execute(['username' => $username, 'email' => $email, 'department' => $department,'password' => $password]);
    //echo "Post Added";
    //}
    ?>

    <div class="rightcolumn">
        <form action="" method="POST">
            <label for="email">Email</label>
            <input id="email" type="text" placeholder="johndoe@gmail.com" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
            <label for="password">Password</label>
            <input id="password" type="password" placeholder="******" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            <button type="submit">LOGIN</button><br>
        </form>
    </div>
</div>




<!-- Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>