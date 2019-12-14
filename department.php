<?php
session_start();
include('check.php');
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
    <link rel="stylesheet" href="css/department.css">
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

    $getPosts = $connection->prepare("SELECT * FROM department_posts where department=:department ORDER BY post_date DESC limit 5");
    $getPosts->execute(['department' => strtolower($_SESSION['department'])]);
    $posts = $getPosts->fetchAll(); 
?>

<!-- Content -->
<div class="department container" style="overflow-x:auto">
    <h1 class="text">Department Resources</h1>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search files.." title="Type in a name">
    <table id="myTable">
        <?php
            $adminsql = "SELECT * FROM admins WHERE email = :email";
            $adminstmt = $connection->prepare($adminsql);
            $adminstmt->execute(['email' => $_SESSION['email']]);
            $adminDelete = "";
        
            if($getUploads->rowCount() < 1){
                echo "<br> No resources at the moment <br> <br>";
            }
            else{
                foreach ($uploads as $upload){

                    if($adminstmt->rowCount() > 0){
                        $adminDelete = "<td class='td2'><button onclick='deleteUpload(".$upload['id'].")'><i href='delete_upload.php?id=".$upload['id']."' class='material-icons'>delete_forever</i></button></td>";
                    };

                    echo "<tr>
                            <td class='td1'>".$upload['filename']."</td>
                            <td class='td2'><a href='uploads/".$_SESSION['department']."/".$upload['filename']."' download><button><i class='material-icons'>file_download</i></button></a></td>
                            ".$adminDelete."
                        </tr>";
                }
            }
        ?>
    </table>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input class="btn-secondary btn-sm btn" type="submit" name="submit" value="Upload File">
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


<!-- <div class="content grid-container grid1 container">
    <div class="grid-item calender">
        <div data-tockify-component="mini" data-tockify-calendar="btm.calender"></div>
        <script data-cfasync="false" data-tockify-script="embed"src="https://public.tockify.com/browser/embed.js"></script>
        <h3><a class="btn btn-sm btn-secondary" href="calender.php">Show Full Calender</a>
        <a class="btn btn-sm btn-secondary" href="https://tockify.com/tkf2/submitEvent/312050c0b844454e8d0ed4327c5e8246" target="_blank">Submit an Event</a></h3>
    </div>
</div> -->

<!-- Department info modal-->
<?php 
    foreach ($posts as $post){
        echo '<div class="modal fade" id="post'.$post["id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
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

function deleteUpload(e){
    window.location.href = "delete_upload.php?id="+e
}
</script>

<!-- Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>