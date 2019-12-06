<?php 
    include("../mysql_conn.php"); 
    session_start();
    if(isset($_POST['title']) && isset($_POST['content']) && !empty($_POST['title']) && !empty($_POST['content'])) {

        $post_title = $_POST['title'];
        $post_content = $_POST['content'];
        $post_description = substr($post_content,0, 200);
        $user_id = $_SESSION['user_id'];

        if(file_exists($_FILES['fileToUpload']['tmp_name']) || is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
            if (!file_exists("../../post_images/")) {
                mkdir("../../post_images/");
            }

            $target_dir = "../../post_images/";
            $basefilename = preg_replace('/\s+/', '_', basename($_FILES["fileToUpload"] ["name"]));
            $target_file = $target_dir . $basefilename;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
                header("Location: ../blog.php?error=invalid_file");
            }else{
                if (file_exists($target_file)) {
                    $basefilename = file_newname($target_dir, $basefilename);
                    $target_file = $target_dir . $basefilename;
                }

                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . $basefilename . " has been uploaded." . "<br>";
                    $filename = $basefilename;
                    
                    $sql = 'INSERT INTO posts (post_title, post_description, post_content, post_image, post_user_id) VALUES(:title, :description, :content, :image, :user_id)';
                    $stmt = $connection->prepare($sql);
                    $stmt->execute(['title' => $post_title, 'description' => $post_description, 'content' => $post_content, 'image' => $filename, 'user_id' => $user_id]);
                    
                    echo "Post Added";
                    header('Location: ../blog.php?success=post_added');
                } else {
                    echo "Sorry, there was an error uploading your file" . "<br>";
                    header("Location: ../blog.php?error=upload_error");
                }
            }

            
        }else{
            $sql = "INSERT INTO posts (post_title, post_description, post_content, post_user_id) VALUES (:title, :description, :content, :user_id)";
            $stmt = $connection->prepare($sql);
            $stmt->execute(['title' => $post_title, 'description' => $post_description, 'content' => $post_content,  'user_id' => $user_id]);

            echo "Post added";
            header('Location: ../blog.php?success=post_added');
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
