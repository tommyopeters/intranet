<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Useful Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="blog.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Blog</title>
</head>
<body>

<?php
include('header.php');
    include('mysql_conn.php');
    $getPosts = $connection->prepare("SELECT * FROM posts");
    $getPosts->execute();
    $posts = $getPosts->fetchAll(); 
?>
<!-- Content -->
    <div class="content">
        <!-- <h1 class="text-center">BLOG</h1> -->
        <div class="grid-container container">
            
<?php
    foreach ($posts as $post) {

        $postUsersql = "SELECT * FROM workers WHERE id = :id";
        
        $postUserStmt = $connection->prepare($postUsersql);
        $postUserStmt->execute(['id' => $post["post_user_id"]]);
        $postUser = $postUserStmt->fetch(PDO::FETCH_ASSOC);
        // echo $post['post_title'] . '<br />';
        echo '<div class="row">
        <h2 class="padding"><a class="header" href="#" data-toggle="modal" data-target="#post'.$post["id"].'">'.$post["post_title"].'</a></h2>
        <div class="info">
            <ul>
                <li><a href=""><i class="far fa-clock"></i>'.$post["post_date"].'</a></li>
                <li><a href=""><i class="far fa-user"></i>'.$postUser["username"].'</a></li>
                <li><a href=""><i class="far fa-comments"></i>Comments</a></li>
            </ul>
        </div>
        <p class="lead padding">'.$post['post_description'].'</p>
        <a class="padding button" href="#" data-toggle="modal" data-target="#post'.$post["id"].'"><i class="material-icons">arrow_forward</i><p>Read More</p></a>
    </div>';
    }
?>
        </div>
    </div>
  
<?php 
    foreach ($posts as $post){
        echo '<div class="modal fade" id="post'.$post["id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header text-center">
                      <h4 class="modal-title w-100 font-weight-bold">'.$post["post_title"].'</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body mx-3 grid-container">
                      <div class="mb-4 grid-item">
                        <img class="modal-img img-responsive" src="img/collaborate.jpg" alt="" width="100%">
                          <p class="lead modal-text">'.$post["post_content"].'</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>';
    }
?>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="footer-cols">
            <ul class="col1">
                <li>BTM Circle</li>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum dignissimos quia quod, expedita dolorem ipsa pariatur aspernatur ullam aperiam dolor, in similique repudiandae autem reiciendis voluptatem sequi nulla est omnis!</p>
            </ul>
            
            <ul class="col2">
                <li>Useful Links</li>
                <li><a href="192.168.83.230">Mail 2</a></li>
                <li><a href="192.168.83.231">Mail 3</a></li>
                <li><a href="http://192.168.83.208/nucorelib/basic_users/login">TRAACS</a></li>
                <li><a href="197.255.61.206">TBF</a></li>
                <li><a href="journeyeasy.net">Journeyeasy</a></li>
                <li><a href="https://192.168.83.226:8008/">Enclave</a></li>
            </ul>
        </div>
    </div>
    <hr>
        <div class="footer-bottom text-center">
        Copyright &copy; 2019 <a href="http://btmlimited.net/">BTML</a>
        </div>
</footer>

<!-- Script links -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>