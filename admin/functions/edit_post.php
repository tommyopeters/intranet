<?php 
    include("../mysql_conn.php"); 
    session_start();
    if(isset($_POST['title']) && isset($_POST['content']) && isset($_GET['id']) && !empty($_POST['title']) && !empty($_POST['content']) && !empty($_GET['id']) ) {

        $post_title = $_POST['title'];
        $post_content = $_POST['content'];
        $post_description = substr($post_content,0, 200);
        $user_id = $_SESSION['user_id'];
        $post_id = $_GET['id'];

        if(file_exists($_FILES['fileToUpload']['tmp_name']) || is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
            if (!file_exists("../../post_images/")) {
                mkdir("../../post_images/");
            }

            $target_dir = "../../post_images/";
            $basefilename = preg_replace('/\s+/', '_', basename($_FILES["fileToUpload"] ["name"]));
            $target_file = $target_dir . $basefilename;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                header("Location: ../blog.php?error=invalid_file");
            }else{
                if (file_exists($target_file)) {
                    $basefilename = file_newname($target_dir, $basefilename);
                    $target_file = $target_dir . $basefilename;
                }

                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $filename = $basefilename;
                    
                    $sql = "UPDATE posts SET post_title=?, post_description=?, post_content=?, post_image=? WHERE id=?";
                    $stmt = $connection->prepare($sql);
                    $stmt->execute([$post_title, $post_description,$post_content, $filename, $post_id]);

                    header('Location: ../blog.php?success=post_edited');
                } else {
                    header("Location: ../blog.php?error=upload_error");
                }
                
            }

            
        }else{
            $sql = "UPDATE posts SET post_title=?, post_description=?, post_content=? WHERE id=?";
            $stmt = $connection->prepare($sql);
            $stmt->execute([$post_title, $post_description,$post_content, $post_id]);

            header('Location: ../blog.php?success=post_edited');
        }
    }

    function file_newname($path, $filename){
        if ($pos = strrpos($filename, '.')) {
            $name = substr($filename, 0, $pos);
            $ext = substr($filename, $pos);
        } else {
               $name = $filename;
        }
    
        $newpath = $path.'/'.$filename;
        $newname = $filename;
        $counter = 0;
        while (file_exists($newpath)) {
               $newname = $name .'_'. $counter . $ext;
               $newpath = $path.'/'.$newname;
               $counter++;
         }
    
        return $newname;
    }
?>