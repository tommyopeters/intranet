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
    <link rel="stylesheet" href="users.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>BTM Circle</title>
</head>
<body>

<?php
    include('log-out.php');
    include('mysql_conn.php');
?>

    <div class="sidebar">
        <a href="index.php">Home</a>
        <a href="users.php" class="active">Users</a>
        <a href="blog.php">Blog</a>
        <a href="departments.php">Departments</a>
        <a href="logout.php" data-toggle="modal" data-target="#logoutmodal">LOG OUT</a>
    </div>
    <div class="content">
        <table class="table">
            <tr>
                <th>Users</th>
                <th>Department</th>
                <th></th>
            </tr>
            <tr>
                <td>firstuser</td>
                <td>IT</td>
                <td><i class="material-icons">delete_forever</i></td>
            </tr>
            <tr>
                <td>seconduser</td>
                <td>Accounts</td>
                <td><i class="material-icons">delete_forever</i></td>
            </tr>
            <tr>
                <td>firstuser</td>
                <td>IT</td>
                <td><i class="material-icons">delete_forever</i></td>
            </tr>
            <tr>
                <td>seconduser</td>
                <td>Accounts</td>
                <td><i class="material-icons">delete_forever</i></td>
            </tr>
        </table>
        <button class="btn btn-info btn-responsive"><a href="" data-toggle="modal" data-target="#usermodal">Add User</a></button>
    </div>
    




<!-- MODALS -->
<div class="modal fade bs-example-modal-md" id="usermodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="username" required>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="janedoe@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                    <label for="department">Department</label>
                    <input type="text" name="department" id="department" placeholder="department" required>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="******" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                </form>
            </div>
            <div class="modal-footer">
                <a href="logout.php" class="btn btn-info btn-responsive btn-block">ADD</a>
            </div>
        </div>
    </div>
</div>


<!-- Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>