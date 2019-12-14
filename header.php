<?php include('mysql_conn.php'); ?>
<link rel="stylesheet" href="css/header.css">
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-fixed-top navbar-light static-top">
    <div class="container">
        <a class="navbar-brand" href="#">  
            <img src="img/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="navbar-item"><a href="index.php">Home</a></li>
                <li class="navbar-item"><a href="blog.php">Blog</a></li>
                <li class="navbar-item">
                    <a href="department.php">Department</a>
                    <!-- <ul class="dropdown-menu">
                        <li><a href="#">IT</a></li>
                        <li><a href="#">Operations</a></li>
                        <li><a href="#">Accounts</a></li>
                        <li><a href="#">Human Resources</a></li>
                        <li><a href="#">Executive</a></li>
                        <li><a href="#">Front Desk</a></li>
                        <li><a href="#">Sales & Marketing</a></li>
                    </ul> -->
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle navbar-item" data-toggle="dropdown" href="#">Useful Links <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="https://192.168.83.230:8443" target="_blank">Mail 2</a></li>
                        <li><a href="https://192.168.83.231:8443" target="_blank">Mail 3</a></li>
                        <li><a href="http://192.168.83.208/nucorelib/basic_users/login" target="_blank">TRAACS</a></li>
                        <li><a href="http://197.255.61.206" target="_blank">TBF</a></li>
                        <li><a href="http://journeyeasy.net" target="_blank">Journeyeasy</a></li>
                        <li><a href="https://192.168.83.226:8008" target="_blank">Enclave</a></li>
                    </ul>
                </li>
                <li class="navbar-item"><a href="#" data-toggle="modal" data-target="#modalcontact">Intercom Directory</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle navbar-itemm" data-toggle="dropdown" href="#"><i class="far fa-user" aria-hidden="true"></i>  <?php echo $_SESSION['username'] ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php">Profile</a></li>
                        <?php
                            $adminsql = "SELECT * FROM admins WHERE email = :email";
                            $adminstmt = $connection->prepare($adminsql);
                            $adminstmt->execute(['email' => $_SESSION['email']]);
                            if($adminstmt->rowCount() > 0){
                                echo '<li><a href="admin/index.php">Admin</a></li>';
                            };
                        ?>
                        
                        <li><a href="logout.php" data-toggle="modal" data-target="#logoutmodal">LOG OUT</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>



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
                <a href="logout.php" class="btn btn-primary btn-block">LOG OUT</a>
            </div>
        </div>
    </div>
</div>