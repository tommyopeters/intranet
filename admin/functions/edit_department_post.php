<?php 
    include("../mysql_conn.php"); 
    session_start();
    if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['department']) && isset($_GET['id']) && !empty($_POST['title']) && !empty($_POST['content'])  && !empty($_POST['department']) && !empty($_GET['id']) ) {

        $post_title = $_POST['title'];
        $post_content = $_POST['content'];
        $post_description = substr($post_content,0, 200);
        $department = $_POST['department'];
        $post_id = $_GET['id'];

        $sql = "UPDATE department_posts SET post_title=?, post_description=?, post_content=?, department=? WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$post_title, $post_description,$post_content,$department, $post_id]);

        echo "Post edited";
        header("Location: ../posts.php?success=post_edited");   
    }

?>