<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Useful Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="department.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Department</title>
</head>
<body>
<!-- Navigation -->
<?php

    include('header.php');
    $current_url = $_SERVER['REQUEST_URI'];
    include('mysql_conn.php');
    $getUploads = $connection->prepare("SELECT * FROM uploads where department=:department");
    $getUploads->execute(['department' => strtolower($_SESSION['department'])]);
    $uploads = $getUploads->fetchAll();

    $getPosts = $connection->prepare("SELECT * FROM department_posts where department=:department");
    $getPosts->execute(['department' => strtolower($_SESSION['department'])]);
    $posts = $getPosts->fetchAll(); 
?>

<!-- Content -->
<div class="department container" style="overflow-x:auto">
    <h1 class="text">Department Resources</h1>
    <hr>
    <table>
        <?php
            if($getUploads->rowCount() < 1){
                echo "<br> No resources at the moment <br> <br>";
            }
            else{
                foreach ($uploads as $upload){
                    echo "<tr>
                            <td class='td1'>".$upload['filename']."</td>
                            <td class='td2'><a href='uploads/".$_SESSION['department']."/".$upload['filename']."' download><button><i class='material-icons'>file_download</i></button></a></td>
                        </tr>";
                }
            }
        ?>
    </table>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input class="btn-secondary btn" type="submit" name="submit" value="Upload File">
    </form>
    <?php
    if (strpos($current_url, "error=file_exists")){
        echo "<p class='text-danger'>Sorry, file already exists.</p>";
    }else if(strpos($current_url, "error=upload_error")){
        echo "<p class='text-danger'>Sorry, there was an error uploading your file</p>";
    }else if(strpos($current_url, "upload=success")){
        echo "<p class='text-success'>File uploaded successfully</p>";
    }
    ?>
</div>
<div class="content container">
    <?php
    foreach($posts as $post){
        echo '<div class="row">
            <h2 class="padding"><a class="header" href="#" data-toggle="modal" data-target="#post'.$post["id"].'">'.$post["post_title"].'</a></h2>
            <p class="lead padding">'.$post['post_description'].'</p>
            <a class="padding button" href="#" data-toggle="modal" data-target="#post'.$post["id"].'"><i class="material-icons">arrow_forward</i><p>Read More</p></a>
        </div>';
    }
    ?>
</div>


<div class="content grid-container grid1 container">
    <div class="grid-item">
        <h1>Info</h1>
        <ul>
            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</li>
            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</li>
            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</li>
            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</li>
            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</li>
        </ul>
    </div>
    <div class="grid-item calender">
        <div data-tockify-component="mini" data-tockify-calendar="btm.calender"></div>
        <script data-cfasync="false" data-tockify-script="embed"src="https://public.tockify.com/browser/embed.js"></script>
        <h3><a class="cbtn1" href="calender.php">Show Full Calender</a>
        <a class="cbtn2" href="https://tockify.com/tkf2/submitEvent/312050c0b844454e8d0ed4327c5e8246" target="_blank">Submit an Event</a></h3>
    </div>
</div>

<!-- Cards
<div class="container carddeck">
    <div class="card-deck">
        <div class="card">
            <img src="img/collaborate.jpg" alt="Avatar" style="width:100%">
            <div class="container cardtext">
                <a href="" data-toggle="modal" data-target="#modalblog1"><h4>How to Collaborate Effectively</h4></a>
            </div>
        </div>
        <div class="card">
            <img src="img/celebrate.jpg" alt="Avatar" style="width:100%">
            <div class="container cardtext">
                <a href="" data-toggle="modal" data-target="#modalblog2"><h4>12 Reasons to Celebrate in the Office</h4></a>
            </div>
        </div>
        <div class="card">
            <img src="img/beautify.jpg" alt="Avatar" style="width:100%">
            <div class="container cardtext">
                <a href="" data-toggle="modal" data-target="#modalblog3"><h4>5 Ways to Beautify your Workspace</h4></a>
            </div>
        </div>
    </div>
</div> -->

<?php 
    foreach ($posts as $post){
        echo '<div class="modal fade" id="post'.$post["id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                  <div class="modal-header text-center">
                      <h4 class="modal-title w-100 font-weight-bold">'.$post["post_title"].'</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body mx-3 grid-container">
                      <div class="mb-4 grid-item">
                          <p class="lead modal-text">'.$post["post_content"].'</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>';
    }
?>


<!-- Department info modal-->
<div class="modal fade" id="modalblog1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">How to Collaborate Effectively</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3 grid-container">
                <div class="mb-5 grid-item">
                    <img class="modal-img" src="img/collaborate.jpg" alt="" width="100%">
                </div>
                <div class="mb-4 grid-item">
                    <p class="lead modal-text">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque harum rem ut sit dolor voluptatum eligendi veniam cum officia, 
                        consequuntur nam ipsum mollitia laborum ratione corrupti iusto ea consectetur soluta. Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Tempora, placeat delectus in dolor mollitia a magni animi cum, ipsa nulla minus eligendi ut deleniti rerum debitis quibusdam ab distinctio quia.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, sapiente nostrum minima perspiciatis dolorum placeat voluptatum, aliquid 
                        in ipsum hic labore? Voluptas quisquam nulla qui quaerat neque odit pariatur excepturi. Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Quam quo temporibus, non ullam atque dolore animi aliquid quasi quidem quisquam corporis ducimus rerum officia voluptate error modi enim perspiciatis ipsam? 
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    </p>
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



<!-- Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>