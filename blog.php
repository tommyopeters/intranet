<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Useful Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/blog.css">
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

    $getComments = $connection->prepare("SELECT * FROM comments");
    $getComments->execute();
    $comments = $getComments->fetchAll(); 
    
    $getUsers = $connection->prepare("SELECT * FROM workers");
    $getUsers->execute();
    $users = $getUsers->fetchAll(); 
?>

<?php
    if(isset($_GET['success'])){
        $success = $_GET['success'];

        if($success == "comment_added"){
            echo "<script>alert('Comment added successfully')</script>";
        }
    }
?>
<!-- Content -->
    <div class="content" >
        <!-- <h1 class="text-center">BLOG</h1> -->
        <div class="grid-container container" id="containerContent">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Posts.." title="Type in a name">
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
                        <li><a href="#" data-toggle="modal" data-target="#commentmodal" onclick="displayComment('.$post["id"].')"><i class="far fa-comments"></i>Comments</a></li>
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
                        <img class="modal-img img-responsive" src="post_images/'.$post["post_image"].'" alt="" width="100%">
                          <p class="lead modal-text">'.$post["post_content"].'</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>';
    }
?>


<!-- Comment -->
<div class="modal fade bs-example-modal-md" id="commentmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Comments</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeComment()">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="postmodal">
                    <dl id="comments-display">
                        
                    </dl>
                    <a href="#" data-post="" data-toggle="modal" data-target="#addcommentmodal" class="button btn btn-block btn-info btn-responsive" id="add-comment-button" onclick="addComment()"><i class="fa fa-plus"></i> Add Comment</a>
                </div>
            </div>
        </div>
    </div>
</div>

  
<!--Modal for adding comment-->
<div class="modal fade bs-example-modal-md" id="addcommentmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Comment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="postmodal">
                    <form action="add_comment.php" method="POST" id="add-comment-form">
                        <div class="fgroup required">
                            <label for="content">Type your comment...</label><br>
                            <textarea name="content" id="content" cols="50" rows="3" placeholder="Fill me with words..."></textarea>
                        </div>
                        <button class="btn btn-block btn-info btn-responsive" type="submit">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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


<script>


console.log();

function myFunction() {
  var input, filter, content, rows, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
//   rows = table.getElementsByTagName("tr");
//   for (i = 0; i < tr.length; i++) {
//     td = tr[i].getElementsByTagName("td")[0];
//     if (td) {
//       txtValue = td.textContent || td.innerText;
//       if (txtValue.toUpperCase().indexOf(filter) > -1) {
//         tr[i].style.display = "";
//       } else {
//         tr[i].style.display = "none";
//       }
//     }       
//   }
    rows = Array.from(document.getElementById("containerContent").querySelectorAll('.row'))
    rows.forEach(row => {
        let header = row.querySelector('.header');
        let txtValue = header.textContent || header.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            row.style.display = "";
          } else {
            row.style.display = "none";
          }
    })

    console.log(rows)
}


<?php 
    $index = 0;
    echo 'let comments = [';
    foreach ($comments as $comment){
        if($index == 0){
            echo '{';
            $index++;
        }else{
            echo ',{';
        }
        echo 'id:'.$comment['id'].', ';
        echo 'content: `'.$comment['content'].'`, ';
        echo 'parent: `'.$comment['post_id'].'`, ';
        echo 'user: `'.$comment['user_id'].'`, ';
        echo '}';
    }
    echo '];';
?>
<?php 
    $newindex = 0;
    echo 'let users = [';
    foreach ($users as $user){
        if($newindex == 0){
            echo '{';
            $newindex++;
        }else{
            echo ',{';
        }
        echo 'id:'.$user['id'].', ';
        echo 'username: `'.$user['username'].'`, ';
        echo '}';
    }
    echo '];';
?>

function displayComment(post_id){
    let addCommentButton = document.getElementById("add-comment-button");
    addCommentButton.dataset.post = post_id;

    let postComments = comments.filter(comment=> comment.parent == post_id);
    let commentsDisplay = document.getElementById("comments-display");

    
    

    postComments.forEach(comment=>{
        let dt = document.createElement("dt");
        dt.innerHTML = comment.content
        let dd = document.createElement("dd");
        let username = users.filter(user=> user.id == comment.user)[0].username;
        dd.innerHTML = "- " + username

        commentsDisplay.appendChild(dt);
        commentsDisplay.appendChild(dd);
    })
}

function addComment(){
    let post_id = document.getElementById("add-comment-button").dataset.post;
    let form = document.getElementById("add-comment-form");
    form.action = "add_comment.php?id=" + post_id;
}

function closeComment(){
    let commentsDisplay = document.getElementById("comments-display");
    commentsDisplay.innerHTML = "";
}
</script>

<!-- Script links -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>