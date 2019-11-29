<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Useful Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="homepage.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>BTM Circle</title>
</head>
<body>

    <?php 
        include('header.php');
        include('mysql_conn.php');
        $getPosts = $connection->prepare("SELECT * FROM posts limit 3");
        $getPosts->execute();
        $posts = $getPosts->fetchAll();
    ?>

    <!-- Header -->
    <div class="welcome">
        <div class="welcome-text">
            <h1>Welcome to the Circle.</h1>
            <div class="input-group buttonInside hide-on-small">
                <input id="email" type="text" class="form-control" name="search" placeholder="Search">
                <button id="searchbutton"><i class="material-icons">search</i></button>   
            </div>
            <!-- <p class="lead hide-on-small">Quick Navigation</p>
            <button class="welcomebutton btn1 hide-on-small hide"><a href="#noticeboard">Notice Board</a></button>
            <button class="welcomebutton btn2 hide-on-small"><a href="#" data-toggle="modal" data-target="#modalcontact">Contact</a></button>
            <button class="welcomebutton btn3"><a href="blog.html">Go to Blog</a></button> -->
            <!-- <button class="welcomebutton btn3 hide-on-large"><a href="blog.html">Go to Blog</a></button> -->
        </div>
    </div>


<!-- Content -->
<div class="grid-container container grid1">
    <div class="grid-item calender">
            <div data-tockify-component="mini" data-tockify-calendar="btm.calender"></div>
            <script data-cfasync="false" data-tockify-script="embed"src="https://public.tockify.com/browser/embed.js"></script>
        <h3><a class="cbtn1" href="calender.html">Show Full Calender</a>
        <a class="cbtn2" href="https://tockify.com/tkf2/submitEvent/312050c0b844454e8d0ed4327c5e8246" target="_blank">Submit an Event</a></h3>
    </div>
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
    <div id="noticeboard" class="grid-item"><script src="https://widgets.remind.com/iframe.js?token=fc34a9d0d860013729520242ac110003&height=400&join=false"></script></div>
</div>

<!-- Cards -->
<div class="container carddeck">
    <div class="card-deck">
        <?php 
            foreach ($posts as $post){
                echo ' <div class="card">
                <img src="img/collaborate.jpg" alt="Avatar" style="width:100%">
                <div class="container cardtext">
                    <a href="" data-toggle="modal" data-target=#post'.$post["id"].'"><h4>'.$post["post_title"].'</h4></a>
                </div>
            </div>';
            }
        ?>
    </div>
</div>

  
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
                        <img src="img/collaborate.jpg" alt="" width="100%">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>