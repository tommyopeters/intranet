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
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>BTM Circle</title>
</head>
<body>

    <?php 
        include('header.php');
        include('mysql_conn.php');
        $getPosts = $connection->prepare("SELECT * FROM posts limit 3");
        $getPosts->execute();
        $posts = $getPosts->fetchAll();

        $getNotices = $connection->prepare("SELECT * FROM department_posts WHERE department = 'general'");
        $getNotices->execute();
        $notices = $getNotices->fetchAll();

    ?>

    <!-- Header -->

    <div id="welcome">
        <h1><i class="fa fa-smile-o"></i>
            <span
                class="txt-rotate"
                data-period="2000"
                data-rotate='[ "Welcome.", "Hello.", "Greetings." ]'></span>
        </h1>
    </div>
    <div class="content">
        <div class="leftcolumn">
            <?php 
            foreach ($posts as $post){
            echo ' 
                <div class="row">
                    <h2 class="padding"><a class="header" href="" data-toggle="modal" data-target="#post'.$post["id"].'">'.$post["post_title"].'</a></h2>
                    <p class="lead padding">Post description</p>
                    <a class="padding button" href="#" data-toggle="modal" data-target="#post'.$post["id"].'"><i class="material-icons">arrow_forward</i><p>Read More</p></a>
                </div>';
                }
            ?>
        </div>
        <div class="rightcolumn">
            <h1 class="header">Notice</h1>
            <!-- <div id="noticeboard" class="grid-item"><script src="https://widgets.remind.com/iframe.js?token=fc34a9d0d860013729520242ac110003&height=400&join=false"></script></div> -->
                
                <?php 
                    foreach ($notices as $notice){
                        echo '<div class="row">
                                <h3 class="header"><a href="#" data-toggle="modal" data-target="#noticemodal'.$notice["id"].'">'.$notice["post_title"].'</a></h3>
                            </div>';
                    }
                ?>
                <br>
                <br>
            <div class="grid-item calender">
                    <div data-tockify-component="mini" data-tockify-calendar="btm.calender"></div>
                    <script data-cfasync="false" data-tockify-script="embed"src="https://public.tockify.com/browser/embed.js"></script>
                <h4><a class="cbtn1" href="calender.php">Show Full Calender</a></h4>
                <h4><a class="cbtn2" href="https://tockify.com/tkf2/submitEvent/312050c0b844454e8d0ed4327c5e8246" target="_blank">Submit an Event</a></h4>
            </div>
        </div>
    </div>
    <!-- <div class="welcome">
        <div class="welcome-text">
            <h1>Welcome to the Circle.</h1>
            <div class="input-group buttonInside hide-on-small">
                <input id="email" type="text" class="form-control" name="search" placeholder="Search">
            </div>
        </div>
    </div> -->



<?php
    foreach($notices as $notice){
        echo '<div class="modal fade bs-example-modal-md" id="noticemodal'.$notice["id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">'.$notice["post_title"].'</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="lead modal-text">'.$notice["post_content"].'</p>
                    </div>
                </div>
            </div>
        </div>';
    }
?>

<!-- Add Notice -->
<div class="modal fade bs-example-modal-md" id="addnoticemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Notice</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="postmodal">
                    <form action="">
                        <div class="fgroup required">
                            <label for="title">Title</label><br>
                            <input class="title" name="title" type="text" placeholder="A new post">
                        </div>
                        <div class="fgroup required">
                            <label for="content">Content</label><br>
                            <textarea name="content" id="content" cols="50" rows="5" placeholder="Fill me with words..."></textarea>
                        </div>
                        <button class="btn btn-block btn-info btn-responsive" type="submit">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="grid-container container grid1">
    
    <!-- <div class="grid-item">
        
    </div> -->
    <!-- <div class="grid-item">
        <h1>Notice Board</h1>
        <dl>
            <dt>Lorem Ipsum Dolor</dt>
            <dd>8:00am Monday</dd>
            <dt>Lorem Ipsum Dolor</dt>
            <dd>12:00am Wednesday</dd>
            <dt>Lorem Ipsum Dolor</dt>
            <dd>1:00pm Saturday</dd>
            <dt>Lorem Ipsum Dolor</dt>
            <dd>4:00pm Tuesday</dd>
        </dl>
    </div> -->

</div>

<!-- Cards -->
<div class="container carddeck">
    <div class="card-deck">
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