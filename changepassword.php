<?php 
  session_start();
      if(isset($_SESSION['username'])){
      header("Location: index.php");
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Useful Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">

    <title>Forgot Password</title>
</head>
<body>
    <div class="bg-image">

    </div>
    <div class="bg-text">
      <h1>Enter E-mail To Reset Password</h1>

<?php
    include('mysql_conn.php');
    
    
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        
        function random_strings($length_of_string){
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
            return substr(str_shuffle($str_result), 0, $length_of_string); 
        }
        $newpassword = random_strings(10).rand(12,98);

        $subject = "Password Reset";
        $txt = "Your new generated password is: ".$newpassword."\n Please login in and change your password";
        $headers = "From: admin@btm.com";

        if(mail($email,$subject,$txt,$headers)){

            $sql = "UPDATE workers SET password=? WHERE email=?";
            $stmt = $connection->prepare($sql);
            $stmt->execute([$email]);

        }else{
            echo "Error sending email. Password not reset";
        }

        
    }
?>

      <form action="" method="POST">
        <input id="email" type="text" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br>
        <button type="submit">Reset Password</button><br>
      </form>
    </div>


<!-- Sign in modal -->
<!-- <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="email" id="defaultForm-email" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="defaultForm-pass" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-default">Go to Circle</button>
      </div>
    </div>
  </div>
</div> -->


<!-- Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>