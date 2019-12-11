
<?php 
    include('mysql_conn.php');
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
        header('Location: ../login.php');
    }
    $adminsql = "SELECT * FROM admins WHERE email = :email";
    $adminstmt = $connection->prepare($adminsql);
    $adminstmt->execute(['email' => $_SESSION['email']]);
    if($adminstmt->rowCount() < 1){
        header('Location: ../index.php');
    };
?>


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
                <a href="../logout.php" class="btn btn-primary btn-block">LOG OUT</a>
            </div>
        </div>
    </div>
</div>

