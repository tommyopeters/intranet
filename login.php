<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Useful Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">

    <title>BTM Circle</title>
</head>
<body>
    <div class="bg-image">

    </div>
    <div class="bg-text">
      <h1>Welcome to BTM Circle.</h1>

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

      <form action="" method="POST">
        <input id="email" type="text" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br>
        <input id="password" type="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
        <button type="submit">LOGIN</button><br>
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