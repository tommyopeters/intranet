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
    <link rel="stylesheet" href="css/admin.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Add Admin</title>
</head>
<body>

<?php
    include('log-out.php');
    include('mysql_conn.php');
?>

    <div class="sidebar">
        <a href="../index.php">Circle</a>
        <a href="index.php">Home</a>
        <a href="users.php">Users</a>
        <a href="posts.php" class="active">Admin</a>
        <a href="blog.php">Blog</a>
        <a href="posts.php">Posts</a>
        <a href="logout.php" data-toggle="modal" data-target="#logoutmodal">LOG OUT</a>
    </div>
    <div class="content">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Admin.." title="Type in a name">
        <table class="table" id="myTable">
            <tr class="header">
                <th>Admins</th>
                <th>Delete Admin</th>
            </tr>
            <tr>
                <td>firstadmin@gmail.com</td>
                <td><button class="btn btn-responsive"><a href="" data-toggle="modal" data-target="#deletemodal"><i class="material-icons">delete_forever</i></a></button></td>
            </tr>
            <tr>
                <td>secondadmin@gmail.com</td>
                <td><button class="btn btn-responsive"><a href="" data-toggle="modal" data-target="#deletemodal"><i class="material-icons">delete_forever</i></a></button></td>
            </tr>
            <tr>
                <td>firstadmin@gmail.com</td>
                <td><button class="btn btn-responsive"><a href="" data-toggle="modal" data-target="#deletemodal"><i class="material-icons">delete_forever</i></a></button></td>
            </tr>
            <tr>
                <td>secondadmin@gmail.com</td>
                <td><button class="btn btn-responsive"><a href="" data-toggle="modal" data-target="#deletemodal"><i class="material-icons">delete_forever</i></a></button></td>
            </tr>
        </table>
        <a href="" class="btn btn-info btn-responsive" data-toggle="modal" data-target="#adminmodal">Add Admin</a>
    </div>
    


<!-- MODALS -->
<!-- Add admin modal -->
<div class="modal fade bs-example-modal-md" id="adminmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="janedoe@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
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

<!-- Delete modal -->
<div class="modal fade bs-example-modal-sm" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="lead modal-text">
                    Are you sure you want to delete this Admin?
                </p>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-primary btn-block">Delete Admin</a>
            </div>
        </div>
    </div>
</div>



<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

<!-- Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>