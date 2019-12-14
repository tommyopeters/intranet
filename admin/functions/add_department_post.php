<?php 
    include("../mysql_conn.php"); 
    session_start();
    if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['department']) && !empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['department'])) {

        $post_title = $_POST['title'];
        $post_content = $_POST['content'];
        $department = $_POST['department'];
        $post_description = substr($post_content,0, 200);

        
        $sql = "INSERT INTO department_posts (post_title, post_description, post_content, department) VALUES (:title, :description, :content, :department)";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['title' => $post_title, 'description' => $post_description, 'content' => $post_content,  'department' => $department]);
        
        header("Location: ../posts.php?success=post_added");
    }
?>
