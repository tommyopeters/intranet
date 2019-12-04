<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Useful Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">
    <!-- <link rel="stylesheet" href="homepage.css"> -->


    <title>Profile</title>
</head>
<body>
    <?php
        session_start();
        include("mysql_conn.php");
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
            header('Location: login.php'); 
        }

        //FORM SUBMISSION INPUTS CHECK
        if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password-prev']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password-prev'])){
            $username = $_POST['username'];
            $department = $_POST['department'];
            $email = $_POST['email'];
            $password_prev = $_POST['password-prev'];
            $password_new = $_POST['password-new'];

            //CHECK IF BOTH USERNAME AND EMAIL ARE WRONG. RETURN ERROR IF BOTH ARE WRONG. VALIDATION IS REQUIRED
            if($username !== $_SESSION['username'] && $email !== $_SESSION['email'] ){
                echo "wrong username and email<br>";
                header("Location: profile.php?error=username&email");
            }
            //CHECK IF ONLY USERNAME IS DIFFERENT.
            else if($username !== $_SESSION['username']){
                echo "username change <br>";

                //CHECK IF NEW USERNAME EXISTS IN DATABASE ALREADY. IF SO, EXIT WITH ERROR
                $quickChecksql = "SELECT * FROM workers WHERE username = :username";
                $quickCheckStmt = $connection->prepare($quickChecksql);
                $quickCheckStmt->execute(['username' => $username]);
                if($quickCheckStmt->rowCount() > 0){
                    echo "username already exists <br>";
                    header("Location: profile.php?error=username_exists");
                }
                //IF NEW USERNAME DOESN'T EXIST, PROCEED
                else{
                    //GET THE FORMER DETAILS OF THE USER FROM THE DATABASE FOR COMPARISON AND CHANGE USING email NOT username (because username is already different)
                    $usernamesql = "SELECT * FROM workers WHERE email = :email";
                    $usernameStmt = $connection->prepare($usernamesql);
                    $usernameStmt->execute(['email' => $email]);
                    //if email query doesn't return value, throw error
                    if($usernameStmt->rowCount() < 1){
                        echo "<p class='text-danger'>Unexpected error. Wrong Email</p>";
                        header("Location: profile.php?error=unexpected_wrong_email");
                    } else {
                        $usernameData = $usernameStmt->fetch(PDO::FETCH_ASSOC);
                        
                        //CHECK IF PASSWORD IS CORRECT TO PROCEED
                        if ($usernameData['password'] == $password_prev){
                            echo "correct password<br>";
                            
                            // CHECK IF THERE'S NO CHANGE IN PASSWORD. THEN DON'T CHANGE PASSWORD IN DATABASE
                            if(empty($password_new) ||$password_new == $password_prev){
                                echo "no new password <br>";
                                
                                //CHECK IF THERE'S CHANGE IN DEPARTMENT. IF SO, THEN CHANGE department AND username IN DATABASE
                                if($department !== $_SESSION['department']){
                                    echo "change department and username<br>";

                                    //CHANGE SQL STATEMENT FOR department AND username
                                    $changesql = "UPDATE workers SET username=:username , department=:department WHERE email = :email";
                                    $changeStmt = $connection->prepare($changesql);
                                    $changeStmt->execute(['username' => $username, 'department' => $department, 'email' => $email]);

                                    //SELECT UPDATED VALUES FROM DATABASE AND SET THE LOGIN INFORMATION
                                    $sql = "SELECT * FROM workers WHERE email = :email";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->execute(['email' => $email]);
                                    //check if updated values aren't retrievable .Return fatal error
                                    if($stmt->rowCount() < 1){
                                        echo "<p class='text-danger'>Fatal Error. Contact Admin</p>";
                                    }
                                    //else set LOGIN information
                                    else{
                                        $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $_SESSION['loggedin'] = true;
                                        $_SESSION['user_id'] = $data['id'];
                                        $_SESSION['username'] = $data['username'];
                                        $_SESSION['email'] = $data['email'];
                                        $_SESSION['department'] = $data['department'];

                                        header('Location: ./profile.php?success=username+department');
                                    }
                                }
                                //CHECK IF THERE'S NO CHANGE IN DEPARTMENT. IF SO, CHANGE ONLY username
                                else{
                                    echo "just change username <br>";

                                    //CHANGE SQL STATEMENT FOR username
                                    $changesql = "UPDATE workers SET username=:username WHERE email = :email";
                                    $changeStmt = $connection->prepare($changesql);
                                    $changeStmt->execute(['username' => $username, 'email' => $email]);

                                    //SELECT UPDATED VALUES FROM DATABASE AND SET THE LOGIN INFORMATION
                                    $sql = "SELECT * FROM workers WHERE email = :email";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->execute(['email' => $email]);
                                    //check if updated values aren't retrievable .Return fatal error
                                    if($stmt->rowCount() < 1){
                                        echo "<p class='text-danger'>Fatal Error. Contact Admin</p>";
                                    }
                                    //else set LOGIN information
                                    else{
                                        $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $_SESSION['loggedin'] = true;
                                        $_SESSION['user_id'] = $data['id'];
                                        $_SESSION['username'] = $data['username'];
                                        $_SESSION['email'] = $data['email'];
                                        $_SESSION['department'] = $data['department'];

                                        header('Location: ./profile.php?success=username');
                                    }
                                }
                            }
                            // CHECK IF THERE'S CHANGE IN PASSWORD. THEN CHANGE password IN DATABASE WITH username
                            else{
                                echo "password change <br>";

                                //CHECK IF THERE'S CHANGE IN DEPARTMENT. IF SO, THEN CHANGE department AND password AND username IN DATABASE
                                if($department !== $_SESSION['department']){
                                    echo "change department and password and username<br>";

                                    //CHANGE SQL STATEMENT FOR department AND username AND password
                                    $changesql = "UPDATE workers SET username=:username , department=:department, password=:password WHERE email = :email";
                                    $changeStmt = $connection->prepare($changesql);
                                    $changeStmt->execute(['username' => $username, 'department' => $department, 'password' => $password_new, 'email' => $email]);

                                    //SELECT UPDATED VALUES FROM DATABASE AND SET THE LOGIN INFORMATION
                                    $sql = "SELECT * FROM workers WHERE email = :email";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->execute(['email' => $email]);
                                    //check if updated values aren't retrievable .Return fatal error
                                    if($stmt->rowCount() < 1){
                                        echo "<p class='text-danger'>Fatal Error. Contact Admin</p>";
                                    }
                                    //else set LOGIN information
                                    else{
                                        $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $_SESSION['loggedin'] = true;
                                        $_SESSION['user_id'] = $data['id'];
                                        $_SESSION['username'] = $data['username'];
                                        $_SESSION['email'] = $data['email'];
                                        $_SESSION['department'] = $data['department'];

                                        header('Location: ./profile.php?success=username+department+password');
                                    }
                                }
                                //CHECK IF THERE'S NO CHANGE IN DEPARTMENT, DON'T CHANGE. IF SO, THEN CHANGE ONLY password AND username IN DATABASE
                                else{
                                    echo "just change username and password<br>";

                                    //CHANGE SQL STATEMENT FOR username AND password
                                    $changesql = "UPDATE workers SET username=:username , password=:password WHERE email = :email";
                                    $changeStmt = $connection->prepare($changesql);
                                    $changeStmt->execute(['username' => $username, 'password' => $password_new, 'email' => $email]);

                                    //SELECT UPDATED VALUES FROM DATABASE AND SET THE LOGIN INFORMATION
                                    $sql = "SELECT * FROM workers WHERE email = :email";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->execute(['email' => $email]);
                                    //check if updated values aren't retrievable .Return fatal error
                                    if($stmt->rowCount() < 1){
                                        echo "<p class='text-danger'>Fatal Error. Contact Admin</p>";
                                    }
                                    //else set LOGIN information
                                    else{
                                        $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $_SESSION['loggedin'] = true;
                                        $_SESSION['user_id'] = $data['id'];
                                        $_SESSION['username'] = $data['username'];
                                        $_SESSION['email'] = $data['email'];
                                        $_SESSION['department'] = $data['department'];

                                        header('Location: ./profile.php?success=username+password');
                                    }
                                }
                            }
                            
                        }
                        //IF PASSWORD NOT THE SAME, PASSWORD WRONG. THROW PASSWORD ERROR
                        else{
                            header("Location: profile.php?error=wrong_password");
                            echo "wrong password<br>";
    
                        }
                    };
                }
            }else if($email !== $_SESSION['email']){
                echo "email change<br>";

                //CHECK IF NEW email EXISTS IN DATABASE ALREADY. IF SO, EXIT WITH ERROR
                $quickChecksql = "SELECT * FROM workers WHERE email = :email";
                $quickCheckStmt = $connection->prepare($quickChecksql);
                $quickCheckStmt->execute(['email' => $email]);
                if($quickCheckStmt->rowCount() > 0){
                    echo "email already exists <br>";
                    header("Location: profile.php?error=email_exists");
                }
                //IF NEW email DOESN'T EXIST, PROCEED
                else{
                    //GET THE FORMER DETAILS OF THE USER FROM THE DATABASE FOR COMPARISON AND CHANGE USING username NOT email (because email is already different)
                    $emailsql = "SELECT * FROM workers WHERE username = :username";
                    $emailStmt = $connection->prepare($emailsql);
                    $emailStmt->execute(['username' => $username]);
                    //if USERNAME query doesn't return value, throw error
                    if($emailStmt->rowCount() < 1){
                        echo "<p class='text-danger'>Unexpected error. Wrong Username</p>";
                    } else {
                        $emailData = $emailStmt->fetch(PDO::FETCH_ASSOC);
                        
                        //CHECK IF PASSWORD IS CORRECT TO PROCEED
                        if ($emailData['password'] == $password_prev){
                            echo "correct password<br>";
                            
                            // CHECK IF THERE'S NO CHANGE IN PASSWORD. THEN DON'T CHANGE PASSWORD IN DATABASE
                            if(empty($password_new) ||$password_new == $password_prev){
                                echo "no new password <br>";
                                
                                //CHECK IF THERE'S CHANGE IN DEPARTMENT. IF SO, THEN CHANGE department AND email IN DATABASE
                                if($department !== $_SESSION['department']){
                                    echo "change department and email<br>";

                                    //CHANGE SQL STATEMENT FOR department AND email
                                    $changesql = "UPDATE workers SET email=:email , department=:department WHERE username = :username";
                                    $changeStmt = $connection->prepare($changesql);
                                    $changeStmt->execute(['email' => $email, 'department' => $department, 'username' => $username]);

                                    //SELECT UPDATED VALUES FROM DATABASE AND SET THE LOGIN INFORMATION
                                    $sql = "SELECT * FROM workers WHERE username = :username";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->execute(['username' => $username]);
                                    //check if updated values aren't retrievable .Return fatal error
                                    if($stmt->rowCount() < 1){
                                        echo "<p class='text-danger'>Fatal Error. Contact Admin</p>";
                                    }
                                    //else set LOGIN information
                                    else{
                                        $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $_SESSION['loggedin'] = true;
                                        $_SESSION['user_id'] = $data['id'];
                                        $_SESSION['username'] = $data['username'];
                                        $_SESSION['email'] = $data['email'];
                                        $_SESSION['department'] = $data['department'];

                                        header('Location: ./profile.php?success=email+department');
                                    }
                                }
                                //CHECK IF THERE'S NO CHANGE IN DEPARTMENT. IF SO, CHANGE ONLY email
                                else{
                                    echo "just change email <br>";

                                    //CHANGE SQL STATEMENT FOR email ONLY
                                    $changesql = "UPDATE workers SET email=:email WHERE username = :username";
                                    $changeStmt = $connection->prepare($changesql);
                                    $changeStmt->execute(['email' => $email, 'username' => $username]);

                                    //SELECT UPDATED VALUES FROM DATABASE AND SET THE LOGIN INFORMATION
                                    $sql = "SELECT * FROM workers WHERE username = :username";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->execute(['username' => $username]);
                                    //check if updated values aren't retrievable .Return fatal error
                                    if($stmt->rowCount() < 1){
                                        echo "<p class='text-danger'>Fatal Error. Contact Admin</p>";
                                    }
                                    //else set LOGIN information
                                    else{
                                        $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $_SESSION['loggedin'] = true;
                                        $_SESSION['user_id'] = $data['id'];
                                        $_SESSION['username'] = $data['username'];
                                        $_SESSION['email'] = $data['email'];
                                        $_SESSION['department'] = $data['department'];

                                        header('Location: ./profile.php?success=email');
                                    }
                                }
                            }
                            // CHECK IF THERE'S CHANGE IN PASSWORD. THEN CHANGE password IN DATABASE WITH email
                            else{
                                echo "password change <br>";

                                //CHECK IF THERE'S CHANGE IN DEPARTMENT. IF SO, THEN CHANGE department AND password AND email IN DATABASE
                                if($department !== $_SESSION['department']){
                                    echo "change department and password and email<br>";

                                    //CHANGE SQL STATEMENT FOR department AND email AND password
                                    $changesql = "UPDATE workers SET email=:email , department=:department, password=:password WHERE username = :username";
                                    $changeStmt = $connection->prepare($changesql);
                                    $changeStmt->execute(['email' => $email, 'department' => $department, 'password' => $password_new, 'username' => $username]);

                                    //SELECT UPDATED VALUES FROM DATABASE AND SET THE LOGIN INFORMATION
                                    $sql = "SELECT * FROM workers WHERE username = :username";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->execute(['username' => $username]);
                                    //check if updated values aren't retrievable .Return fatal error
                                    if($stmt->rowCount() < 1){
                                        echo "<p class='text-danger'>Fatal Error. Contact Admin</p>";
                                    }
                                    //else set LOGIN information
                                    else{
                                        $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $_SESSION['loggedin'] = true;
                                        $_SESSION['user_id'] = $data['id'];
                                        $_SESSION['username'] = $data['username'];
                                        $_SESSION['email'] = $data['email'];
                                        $_SESSION['department'] = $data['department'];

                                        header('Location: ./profile.php?success=email+department+password');
                                    }
                                }
                                //CHECK IF THERE'S NO CHANGE IN DEPARTMENT, DON'T CHANGE. IF SO, THEN CHANGE ONLY password AND email IN DATABASE
                                else{
                                    echo "just change username and password<br>";

                                    //CHANGE SQL STATEMENT FOR email AND password
                                    $changesql = "UPDATE workers SET email=:email , password=:password WHERE username = :username";
                                    $changeStmt = $connection->prepare($changesql);
                                    $changeStmt->execute(['email' => $email, 'password' => $password_new, 'username' => $username]);

                                    //SELECT UPDATED VALUES FROM DATABASE AND SET THE LOGIN INFORMATION
                                    $sql = "SELECT * FROM workers WHERE email = :email";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->execute(['email' => $email]);
                                    //check if updated values aren't retrievable .Return fatal error
                                    if($stmt->rowCount() < 1){
                                        echo "<p class='text-danger'>Fatal Error. Contact Admin</p>";
                                    }
                                    //else set LOGIN information
                                    else{
                                        $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $_SESSION['loggedin'] = true;
                                        $_SESSION['user_id'] = $data['id'];
                                        $_SESSION['username'] = $data['username'];
                                        $_SESSION['email'] = $data['email'];
                                        $_SESSION['department'] = $data['department'];

                                        header('Location: ./profile.php?success=email+password');
                                    }
                                }
                            }
                            
                        }
                        //IF PASSWORD NOT THE SAME, PASSWORD WRONG. THROW PASSWORD ERROR
                        else{
                            header("Location: profile.php?error=wrong_password");
                            echo "wrong password<br>";
    
                        }
                    };
                }
            }else if($department !== $_SESSION['department']){
                echo "change department only<br>";

                //GET THE FORMER DETAILS OF THE USER FROM THE DATABASE FOR COMPARISON AND CHANGE USING username NOT email (because email is already different)
                $emailsql = "SELECT * FROM workers WHERE username = :username";
                $emailStmt = $connection->prepare($emailsql);
                $emailStmt->execute(['username' => $username]);
                //if USERNAME query doesn't return value, throw error
                if($emailStmt->rowCount() < 1){
                    echo "<p class='text-danger'>Unexpected error. Wrong Username</p>";
                } else {
                    $emailData = $emailStmt->fetch(PDO::FETCH_ASSOC);
                    
                    //CHECK IF PASSWORD IS CORRECT TO PROCEED
                    if ($emailData['password'] == $password_prev){
                        echo "correct password<br>";
                        
                        //CHANGE SQL STATEMENT FOR department ONLY
                        $changesql = "UPDATE workers SET  department=:department WHERE email = :email";
                        $changeStmt = $connection->prepare($changesql);
                        $changeStmt->execute(['department' => $department , 'email' => $email]);

                        //SELECT UPDATED VALUES FROM DATABASE AND SET THE LOGIN INFORMATION
                        $sql = "SELECT * FROM workers WHERE email = :email";
                        $stmt = $connection->prepare($sql);
                        $stmt->execute(['email' => $email]);
                        //check if updated values aren't retrievable .Return fatal error
                        if($stmt->rowCount() < 1){
                            echo "<p class='text-danger'>Fatal Error. Contact Admin</p>";
                        }
                        //else set LOGIN information
                        else{
                            $data = $stmt->fetch(PDO::FETCH_ASSOC);
                            $_SESSION['loggedin'] = true;
                            $_SESSION['user_id'] = $data['id'];
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['email'] = $data['email'];
                            $_SESSION['department'] = $data['department'];

                            header('Location: ./profile.php?success=department');
                        }
                        
                    }
                    //IF PASSWORD NOT THE SAME, PASSWORD WRONG. THROW PASSWORD ERROR
                    else{
                        header("Location: profile.php?error=wrong_password");
                        echo "wrong password<br>";

                    }
                }

                

            }else if(!empty($password_new) && $password_new !== $password_prev){
                echo "password change only <br>";


                //GET THE FORMER DETAILS OF THE USER FROM THE DATABASE FOR COMPARISON AND CHANGE USING username NOT email (because email is already different)
                $emailsql = "SELECT * FROM workers WHERE username = :username";
                $emailStmt = $connection->prepare($emailsql);
                $emailStmt->execute(['username' => $username]);
                //if USERNAME query doesn't return value, throw error
                if($emailStmt->rowCount() < 1){
                    echo "<p class='text-danger'>Unexpected error. Wrong Username</p>";
                } else {
                    $emailData = $emailStmt->fetch(PDO::FETCH_ASSOC);
                    
                    //CHECK IF PASSWORD IS CORRECT TO PROCEED
                    if ($emailData['password'] == $password_prev){
                        echo "correct password<br>";
                        
                        //CHANGE SQL STATEMENT FOR password ONLY
                        $changesql = "UPDATE workers SET password=:password WHERE email = :email";
                        $changeStmt = $connection->prepare($changesql);
                        $changeStmt->execute(['password' => $password_new, 'email' => $email]);

                        //SELECT UPDATED VALUES FROM DATABASE AND SET THE LOGIN INFORMATION
                        $sql = "SELECT * FROM workers WHERE email = :email";
                        $stmt = $connection->prepare($sql);
                        $stmt->execute(['email' => $email]);
                        //check if updated values aren't retrievable .Return fatal error
                        if($stmt->rowCount() < 1){
                            echo "<p class='text-danger'>Fatal Error. Contact Admin</p>";
                        }
                        //else set LOGIN information
                        else{
                            $data = $stmt->fetch(PDO::FETCH_ASSOC);
                            $_SESSION['loggedin'] = true;
                            $_SESSION['user_id'] = $data['id'];
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['email'] = $data['email'];
                            $_SESSION['department'] = $data['department'];

                            header('Location: ./profile.php?success=password');
                        }
                        
                        
                    }
                    //IF PASSWORD NOT THE SAME, PASSWORD WRONG. THROW PASSWORD ERROR
                    else{
                        header("Location: profile.php?error=wrong_password");
                        echo "wrong password<br>";

                    }
                }
                
            }else{
                echo "no change whatsoever <br>";
                header("Location: profile.php?change=none");
            }
            
        }
    ?>
    <div class="bg-image">

    </div>
    <div class="grid-container container bg-text">
        <div class="grid-item one col-md-12 col-sm-12">
            <img src="img/headshot.jpg" alt="User">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="department.php">Department</a></li>
                <li class="dropdown">
                        <a class="dropdown-toggle navbar-item" data-toggle="dropdown" href="#">Useful Links <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="192.168.83.230">Mail 2</a></li>
                            <li><a href="192.168.83.231">Mail 3</a></li>
                            <li><a href="http://192.168.83.208/nucorelib/basic_users/login">TRAACS</a></li>
                            <li><a href="197.255.61.206">TBF</a></li>
                            <li><a href="journeyeasy.net">Journeyeasy</a></li>
                            <li><a href="https://192.168.83.226:8008/">Enclave</a></li>
                        </ul>
                    </li>
                    <li><a href="#" data-toggle="modal" data-target="#modalcontact">Contact</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#logoutmodal">LOG OUT</a></li>
            </ul>
        </div>
        <div class="grid-item two col-md-12 col-sm-12">
            <h1 class="header">Edit Profile</h1>
            <?php 
                $current_url = $_SERVER['REQUEST_URI'];

                if (strpos($current_url, "error=username&email")){
                    echo "<p class='text-danger'>Username and Email wrong. You can't change both at once.</p>";
                }else if(
                    strpos($current_url, "error=username_exists")){
                    echo "<p class='text-danger'>Username already exists</p>";
                }else if(
                    strpos($current_url, "error=unexpected_wrong_email")){
                    echo "<p class='text-danger'>Unexpected error with email</p>";
                }else if(
                    strpos($current_url, "error=wrong_password")){
                    echo "<p class='text-danger'>Wrong Password</p>";
                }else if(
                    strpos($current_url, "error=email_exists")){
                    echo "<p class='text-danger'>Email already exists</p>";
                }else if(
                    strpos($current_url, "success=username+department+password")){
                    echo "<p class='text-success'>Username, Department and Password changed</p>";
                }else if(
                    strpos($current_url, "success=email+department+password")){
                    echo "<p class='text-success'>Email, Department and Password changed</p>";
                }else if(
                    strpos($current_url, "success=username+department")){
                    echo "<p class='text-success'>Username and Department changed</p>";
                }else if(
                    strpos($current_url, "success=email+department")){
                    echo "<p class='text-success'>Email and Department changed</p>";
                }else if(
                    strpos($current_url, "success=username+password")){
                    echo "<p class='text-success'>Username and Password changed</p>";
                }else if(
                    strpos($current_url, "success=email+password")){
                    echo "<p class='text-success'>Email and Password changed</p>";
                }else if(
                    strpos($current_url, "success=username")){
                    echo "<p class='text-success'>Username changed</p>";
                }else if(
                    strpos($current_url, "success=email")){
                    echo "<p class='text-success'>Email changed</p>";
                }else if(
                    strpos($current_url, "success=department")){
                    echo "<p class='text-success'>Department changed</p>";
                }else if(
                    strpos($current_url, "success=password")){
                    echo "<p class='text-success'>Password changed</p>";
                }else if(
                    strpos($current_url, "change=none")){
                    echo "<p class='text-primary'>No changes made</p>";
                }
            ?>
            <form action="" method="POST" id="profile-form">
                <div class="fgroup required">
                    <label for="username">Name</label>
                    <input class="name" type="text" name="username" value="<?php echo $_SESSION['username'] ?>">
                </div>
                <div class="fgroup required">
                    <label for="department">Department</label><br>
                    <select name="department" id="department">
                        <option value="<?php echo $_SESSION['department']; ?>" default>Select Department</option>
                        <option value="front-desk">Front Desk</option>
                        <option value="it">IT</option>
                        <option value="operations">Operations</option>
                        <option value="accounts">Accounts</option>
                        <option value="sales-and-marketing">Sales & Marketing</option>
                        <option value="hr">HR</option>
                        <option value="executives">Executives</option>
                    </select>
                </div>
                <div class="fgroup required">
                	<label for="email">Email</label>
                	<input class="email" type="text" value="<?php echo $_SESSION['email'] ?>" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                </div>
                <div class="fgroup required">
                	<label for="password-prev">Previous password</label>
                	<input class="password" type="password" placeholder="Insert Previous Password" name="password-prev" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                </div>
                <div class="fgroup">
                	<label for="password">New password</label>
                	<input class="password-new" type="password" placeholder="Leave field empty if you don't want password change" name="password-new" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div>
                <button type="submit">Edit</button>
            </form>
        </div>
    </div>
    <!-- <div class="bg-text">
      <h1>Welcome to BTM Circle.</h1>
      <form action="login.php">
        <input id="email" type="text" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br>
        <input id="password" type="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
        <button type="submit">LOGIN</button><br>
      </form>
    </div> -->

<!-- Modals -->
<!-- Contact -->
<div class="modal fade" id="modalcontact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Extensions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <table class="table table-sm table-responsive">
                    <thead class="thead-light">
                        <tr>
                            <th>Operations</th>
                            <th>IT</th>
                            <th>Front Desk</th>
                            <th>Accounts</th>
                            <th>Human Resources</th>
                            <th>Executive</th>
                            <th>Sales & Marketing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>4037 - Mutiu Badmus</td>
                            <td>4003 - Folusho Alade</td>
                            <td>4000 - Reception</td>
                            <td>4010 - Head of Accounts</td>
                            <td>4006 - Gbenga Alayande</td>
                            <td>4040 - EDCS</td>
                            <td>4063 - Aderemi Omomukuyo</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4025 - Bukola Adisa</td>
                            <td>4005 - Micheal Ogbuniba</td>
                            <td>4019 - Olatunde Olaitan</td>
                            <td>4033 - Tunde Awoyemi</td>
                            <td>4057 - Praise Umar</td>
                            <td>4018 - Lola Adefope</td>
                            <td>4031 - Onyinye Eke</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4026 - Kemi Onaolapo</td>
                            <td>4002 - Ukachi Irukwu</td>
                            <td>4060 - Prisca Omenai (VIP DESK)</td>
                            <td>4036 - Abiola Oyekola</td>
                            <td></td>
                            <td>4041 - Ibironke Gbemisola</td>
                            <td>4009 - Oyinkansola Abe</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4011 - Temitope Adegoke (KEY ACCOUNTS)</td>
                            <td>4008 - Oluwaseun Badejo</td>
                            <td>4093 - Florence Adiele (VIP DESK)</td>
                            <td>4039 - Kolawole Babatayo</td>
                            <td></td>
                            <td>4038 - Cynthia Enumah</td>
                            <td>4053 - Rita Abara</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4035 - Ali Basil (KEY ACCOUNTS)</td>
                            <td></td>
                            <td></td>
                            <td>4050 - Temitope Osilagun</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4014 - Kelechi Ohadebere (KEY ACCOUNTS)</td>
                            <td></td>
                            <td></td>
                            <td>4050 - Temitope Osilagun</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4062 - Moyosore Okuwa (GE)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4054 - Henry Enyi (GE)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4015 - Card Swiping Officer (GE)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4016 - Ololade (DOMESTIC TICKETING)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4017 - Julius (DOMESTIC TICKETING)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table class="table table-sm table-responsive">
                    <thead class="thead-light">
                        <tr>
                            <th>Hotel & Car Hire</th>
                            <th>Immigrations</th>
                            <th>HRG Angola</th>
                            <th>Implants</th>
                            <th>Airport</th>
                            <th>Other</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>4044 - Doyin Salami</td>
                            <td>4028 - Ebunoluwa Daramola</td>
                            <td>4090 - Sola Adenuga</td>
                            <td>4056 - Temidayo Isabemueh (PWC)</td>
                            <td>4091 - HRG MMA 2 (ABUJA)</td>
                            <td>2010 - Conference Room</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4045 - Elga Albert</td>
                            <td>4029 - Titi Animashaun</td>
                            <td>4072 - Victoria Ojebor</td>
                            <td>4067 - Samson Babatunde (UNILEVER)</td>
                            <td>4092 - Robinson Fiewor (LAGOS)</td>
                            <td>6060 - Monday Morning Call</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>4030 - Augusta Okhide</td>
                            <td>4098 - HRG Angola Office 3</td>
                            <td>4059 - Ayodele Niniola (SHELL)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>4097 - HRG Angola Office 2</td>
                            <td>4069 - Oluseyi Abdul (SHELL)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4073 - Saviour Okachi (SHELL)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4076 - James Agu (GUINESS)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4100 - Olalekan Amodu (WORLD BANK LAGOS)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4099 - Alex N. (WORLD BANK ABUJA)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4080 - Alimat Olawumi (TETRAPAK)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4077 - Adetayo Sarumi (FHI360)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4051 - Mariam Bokri (FHI-ANNI)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Log out -->
<div class="modal fade bs-example-modal-sm" id="logoutmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">LOG OUT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="lead modal-text">
                    Are you sure you want to Log out?
                </p>
            </div>
            <div class="modal-footer">
                <a href="logout.php" class="btn btn-primary btn-block">LOG OUT</a>
            </div>
        </div>
    </div>
</div>
 


<!-- Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- <script>
        $(document).ready(function(){
            $("#profile-form").submit(e=>{
                e.preventDefault();
                let proceed = true;
                let form = document.getElementById('profile-form')

                if(form.password)
            })
        });
    </script> -->
</body>
</html>