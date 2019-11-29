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


<!-- Modals -->
            <!-- Contact -->
<div class="modal fade" id="modalcontact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Extensions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <table class="table table-sm table-responsive">
                    <thead class="thead-light">
                        <tr>
                            <th>Operations</th>
                            <th>IT</th>
                            <th>Front Desk</th>
                            <th>Accounts</th>
                            <th>Human Resources</th>
                            <th>Executive</th>
                            <th>Sales & Marketing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>4037 - Mutiu Badmus</td>
                            <td>4003 - Folusho Alade</td>
                            <td>4000 - Reception</td>
                            <td>4010 - Head of Accounts</td>
                            <td>4006 - Gbenga Alayande</td>
                            <td>4040 - EDCS</td>
                            <td>4063 - Aderemi Omomukuyo</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4025 - Bukola Adisa</td>
                            <td>4005 - Micheal Ogbuniba</td>
                            <td>4019 - Olatunde Olaitan</td>
                            <td>4033 - Tunde Awoyemi</td>
                            <td>4057 - Praise Umar</td>
                            <td>4018 - Lola Adefope</td>
                            <td>4031 - Onyinye Eke</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4026 - Kemi Onaolapo</td>
                            <td>4002 - Ukachi Irukwu</td>
                            <td>4060 - Prisca Omenai (VIP DESK)</td>
                            <td>4036 - Abiola Oyekola</td>
                            <td></td>
                            <td>4041 - Ibironke Gbemisola</td>
                            <td>4009 - Oyinkansola Abe</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4011 - Temitope Adegoke (KEY ACCOUNTS)</td>
                            <td>4008 - Oluwaseun Badejo</td>
                            <td>4093 - Florence Adiele (VIP DESK)</td>
                            <td>4039 - Kolawole Babatayo</td>
                            <td></td>
                            <td>4038 - Cynthia Enumah</td>
                            <td>4053 - Rita Abara</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4035 - Ali Basil (KEY ACCOUNTS)</td>
                            <td></td>
                            <td></td>
                            <td>4050 - Temitope Osilagun</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4014 - Kelechi Ohadebere (KEY ACCOUNTS)</td>
                            <td></td>
                            <td></td>
                            <td>4050 - Temitope Osilagun</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4062 - Moyosore Okuwa (GE)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4054 - Henry Enyi (GE)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4015 - Card Swiping Officer (GE)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4016 - Ololade (DOMESTIC TICKETING)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4017 - Julius (DOMESTIC TICKETING)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table class="table table-sm table-responsive">
                    <thead class="thead-light">
                        <tr>
                            <th>Hotel & Car Hire</th>
                            <th>Immigrations</th>
                            <th>HRG Angola</th>
                            <th>Implants</th>
                            <th>Airport</th>
                            <th>Other</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>4044 - Doyin Salami</td>
                            <td>4028 - Ebunoluwa Daramola</td>
                            <td>4090 - Sola Adenuga</td>
                            <td>4056 - Temidayo Isabemueh (PWC)</td>
                            <td>4091 - HRG MMA 2 (ABUJA)</td>
                            <td>2010 - Conference Room</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>4045 - Elga Albert</td>
                            <td>4029 - Titi Animashaun</td>
                            <td>4072 - Victoria Ojebor</td>
                            <td>4067 - Samson Babatunde (UNILEVER)</td>
                            <td>4092 - Robinson Fiewor (LAGOS)</td>
                            <td>6060 - Monday Morning Call</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>4030 - Augusta Okhide</td>
                            <td>4098 - HRG Angola Office 3</td>
                            <td>4059 - Ayodele Niniola (SHELL)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>4097 - HRG Angola Office 2</td>
                            <td>4069 - Oluseyi Abdul (SHELL)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4073 - Saviour Okachi (SHELL)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4076 - James Agu (GUINESS)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4100 - Olalekan Amodu (WORLD BANK LAGOS)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4099 - Alex N. (WORLD BANK ABUJA)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4080 - Alimat Olawumi (TETRAPAK)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4077 - Adetayo Sarumi (FHI360)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>4051 - Mariam Bokri (FHI-ANNI)</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


 

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
                <a href="login.php" class="btn btn-primary btn-block">LOG OUT</a>
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
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>