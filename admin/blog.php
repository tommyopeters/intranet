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
    <link rel="stylesheet" href="css/blog.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>BTM Circle</title>
</head>
<body>

<?php
    include('log-out.php');
    include('mysql_conn.php');
    include('sidebar_menu.php');

    $getPosts = $connection->prepare("SELECT * FROM posts");
    $getPosts->execute();
    $posts = $getPosts->fetchAll(); 


    if(isset($_GET['error'])){
        $error = $_GET['error'];
        if($error == "invalid_file"){
            echo "<script>alert('Invalid file. Please, upload an image.')</script>";
        }
        if($error == "upload_error"){
            echo "<script>alert('Upload error, please try again.')</script>";
        }
        if($error == "fatal"){
            echo "<script>alert('Fatal error')</script>";
        }
        
    }
    if(isset($_GET['success'])){
        $success = $_GET['success'];
        if($success == "post_edited"){
            echo "<script>alert('Post edited successfully')</script>";
        }
        if($success == "post_deleted"){
            echo "<script>alert('Post deleted successfully')</script>";
        }
        if($success == "post_added"){
            echo "<script>alert('Post added successfully')</script>";
        }
    }
?>

    <div class="content">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for blog post.." title="Type in a name">
        <table class="table" id="myTable">
            <tr class="header">
                <th>Blog Posts</th>
                <th>Date Posted</th>
                <th>Edit Post</th>
                <th>Delete Post</th>
            </tr>
            <?php 
                foreach ($posts as $post){
                    echo '
                        <tr>
                            <td>'.$post["post_title"].'</td>
                            <td>'.date( 'd-m-Y', strtotime($post["post_date"]) ).'</td>
                            <td><button class="btn btn-responsive" onclick="editPostModal('.$post['id'].')"><a href="" data-toggle="modal" data-target="#editdepmodal"><i class="far fa-edit"></i></a></button></td>
                            <td><button class="btn btn-responsive" onclick="deletePostModal('.$post['id'].')"><a href="" data-toggle="modal" data-target="#deletemodal"><i class="material-icons">delete_forever</i></a></button></td>
                        </tr>
                        ';
                }
            ?>
        </table>
        <a href="" class="btn btn-info btn-responsive" data-toggle="modal" data-target="#postmodal">Add Post</a>
    </div>
    




<!-- Add post modal -->
<div class="modal fade bs-example-modal-lg" id="postmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Blog Post</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="postmodal">
                    <form action="functions/add_post.php" method="POST" enctype="multipart/form-data">
                        <div class="fgroup required">
                            <label for="title">Post Title</label><br>
                            <input class="title" name="title" type="text" placeholder="A new post" required>
                        </div>
                        <div class="fgroup required">
                            <label for="content">Post Content</label><br>
                            <textarea name="content" id="content" cols="90" rows="10" placeholder="Fill me with words..." required></textarea>
                        </div>
                        <div class="fgroup">
                            <label for="image">Upload an image: </label>
                            <input type="file" name="fileToUpload" id="fileToUpload1">
                        </div>
                        <button class="btn btn-block btn-info btn-responsive" type="submit">ADD</button>
                    </form>
                </div>
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
                    Are you sure you want to delete this post?
                </p>
            </div>
            <div class="modal-footer">
                <a href="" id="delete-post" class="btn btn-primary btn-block">Delete Post</a>
            </div>
        </div>
    </div>
</div>



<!-- Edit depmodal -->
<div class="modal fade bs-example-modal-lg" id="editdepmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Edit Post</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="postmodal">
                    <form action="" id="edit-post-form" method="POST" enctype="multipart/form-data">
                        <div class="fgroup required">
                            <label for="title">Post Title</label><br>
                            <input class="title" name="title" type="text" placeholder="A new post" required>
                        </div>
                        <div class="fgroup required">
                            <label for="content">Post Content</label><br>
                            <textarea name="content" id="content" cols="90" rows="5" placeholder="Fill me with words..." required></textarea>
                        </div>
                        <div class="fgroup">
                            <label for="fileToUpload">New Post Image: </label>
                            <input type="file" name="fileToUpload" id="fileToUpload2">
                        </div>
                        <button class="btn btn-block btn-info btn-responsive" type="submit">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Script links -->

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

<?php 
    $index = 0;
    echo 'let posts = [';
    foreach ($posts as $post){
        if($index == 0){
            echo '{';
            $index++;
        }else{
            echo ',{';
        }
        echo 'id:'.$post['id'].', ';
        echo 'title: `'.$post['post_title'].'`, ';
        echo 'content: `'.$post['post_content'].'`, ';
        echo '}';
    }
    echo '];';
?>

function editPostModal(id){
    let post = posts.filter(post => {
        if(post.id == id){
            return true;
        }
    })[0]
    let form = document.getElementById('edit-post-form');
    form.title.value = post.title
    form.content.value = post.content
    form.action = "functions/edit_post.php?id="+post.id;
}

function deletePostModal(id){
    let deleteButton = document.getElementById('delete-post');
    deleteButton.href = "functions/delete_post.php?id="+id;
}


</script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</body>
</html>