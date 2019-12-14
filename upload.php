<?php  
session_start();
$user_id = $_SESSION['user_id'];
$department = $_SESSION['department'];
if (!file_exists("uploads/")) {
  mkdir("uploads/");
}
$target_dir = "uploads/".$department."/";
if (!file_exists($target_dir)) {
  mkdir($target_dir);
}
$basefilename = preg_replace('/\s+/', '_', basename($_FILES["fileToUpload"] ["name"])); 
$target_file = $target_dir . $basefilename;
$uploadOk = 1;
//check if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
    header("Location: department.php?error=file_exists");
  }

  else {
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      
      include('mysql_conn.php');
      $filename = $basefilename;
      
      
      $sql = 'INSERT INTO uploads(filename, upload_user_id, department) VALUES(:filename, :user_id, :department)';
      $stmt = $connection->prepare($sql);
      $stmt->execute(['filename' => $filename, 'user_id' => $user_id, 'department' => $department]);
      
      header('Location: department.php?upload=success');
    } else {
      header("Location: department.php?error=upload_error");
    }
  }
?>  