<?php
    include('admin_check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Useful Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="index.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>BTM Circle</title>
</head>
<body>

<?php
    include('log-out.php');
    include('mysql_conn.php');
    include('sidebar_menu.php');

?>

    <div class="header">
        <div id="welcome">
            <h1>Good 
                <span
                    class="txt-rotate"
                    data-period="2000"
                    data-rotate='[ "Morning.", "Afternoon.", "Evening.", "Day." ]'></span>
            </h1>
        </div>
        <div class="content col-md-12 col-sm-12">
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
                    <label for="username">Name</label> <br>
                    <input class="name" type="text" name="username" value="<?php echo $_SESSION['username'] ?>" placeholder="janedoe">
                </div>
                <div class="fgroup required">
                    <label for="password-prev">Previous password</label> <br>
                	<input class="password" type="password" placeholder="Insert Previous Password" name="password-prev" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="*****" required>
                </div>
                <div class="fgroup">
                	<label for="password">New password</label> <br>
                	<input class="password-new" type="password" placeholder="Leave field empty if you don't want password change" name="password-new" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="*****">
                </div>
                <button type="submit" class="btn btn-info btn-reponsive">Edit</button>
            </form>
        </div>
    </div>



<!-- Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>