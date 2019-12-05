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
    <link rel="stylesheet" href="css/users.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Users</title>
</head>
<body>

<?php
    include('log-out.php');
    include('mysql_conn.php');
    include('sidebar_menu.php');

    $getUsers = $connection->prepare("SELECT * FROM workers");
    $getUsers->execute();
    $users = $getUsers->fetchAll(); 

?>
    <div class="content">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for User.." title="Type in a name">
        <table class="table" id="myTable">
            <tr class="header">
                <th>Users</th>
                <th>Department</th>
                <th>Delete User</th>
                <th></th>
            </tr>
            
            <!-- <tr>
                <td>seconduser</td>
                <td>Accounts</td>
                <td><button class="btn btn-responsive"><a href="" data-toggle="modal" data-target="#deletemodal"><i class="material-icons">delete_forever</i></a></button></td>
                <td><a href="" class="btn btn-info btn-responsive">Add Admin</a></td>
            </tr> -->
            <?php
                foreach ($users as $user){
                    if($user['department']=="it"){
                        $department = strtoupper($user['department']);
                    }else if($user['department']=="sales-and-marketing"){
                        $department = "Sales & Marketing";
                    }else{
                        $department = ucwords($user['department']);
                    }
                    if ($user['username'] !== $_SESSION['username']){
                        echo '
                        <tr>
                            <td>'.$user["username"].'</td>
                            <td>'.$department.'</td>
                            <td><button class="btn btn-responsive" onclick="deleteModal('.$user["id"].',`'.$user["username"].'`)"><a href="" data-toggle="modal" data-target="#deletemodal"><i class="material-icons">delete_forever</i></a></button></td>
                            <td><a href="" onclick="addAdminModal('.$user["id"].',`'.$user["username"].'`)" data-toggle="modal" data-target="#addadminmodal" class="btn btn-info btn-responsive">Add Admin</a></td>
                        </tr>
                        ';
                    }
                    
                }
            ?>
        </table>
        <a href="" class="btn btn-info btn-responsive" data-toggle="modal" data-target="#usermodal">Add User</a>
    </div>
    


<!-- MODALS -->
<!-- Add user modal -->
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
                <form id="add-user-form" action="functions/add_user.php" method="POST">
                    <div class="form-group required">
                        <label for="username">Name</label>
                        <input type="text" name="username" id="username" placeholder="name" required>
                    </div>
                    <div class="form-group required">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="janedoe@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                    </div>
                    <div class="form-group required">
                        <label for="department">Department</label> <br>
                        <select name="department" id="department">
                            <option value="" default>Select Department</option>
                            <option value="front-desk">Front Desk</option>
                            <option value="it">IT</option>
                            <option value="operations">Operations</option>
                            <option value="accounts">Accounts</option>
                            <option value="sales-and-marketing">Sales & Marketing</option>
                            <option value="hr">HR</option>
                            <option value="executives">Executives</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="" id="add-user-button" onclick="formCheck(event)" class="btn btn-info btn-responsive btn-block">ADD</a>
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
                <p class="lead modal-text" id="delete-user-confirm">
                    Are you sure you want to delete this User?
                </p>
            </div>
            <div class="modal-footer">
                <a href="" id="delete-user" class="btn btn-primary btn-block">Delete User</a>
            </div>
        </div>
    </div>
</div>

<!-- Add Admin modal -->
<div class="modal fade bs-example-modal-sm" id="addadminmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="lead modal-text" id="add-admin-confirm">
                    Are you sure you want to make an admin?
                </p>
            </div>
            <div class="modal-footer">
                <a href="" id="add-admin" class="btn btn-primary btn-block">Make Admin</a>
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

    function deleteModal(id, username) {
        document.getElementById("delete-user").href = "functions/delete_user.php?id="+id;
        document.getElementById("delete-user-confirm").innerHTML = "Are you sure you want to delete <em>"+username+"</em>?";
    }
    function addAdminModal(id, username) {
        document.getElementById("add-admin").href = "functions/add_admin.php?id="+id;
        document.getElementById("add-admin-confirm").innerHTML = "Are you sure you want to make <em>"+username+"</em> an admin?";
    }

    function formCheck(e){
        e.preventDefault();
        let form = document.getElementById('add-user-form');

        form.submit();

    }
</script>

<!-- Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


</body>
</html>