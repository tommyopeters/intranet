<?php 
    include("mysql_conn.php"); 
    session_start();
    if(isset($_POST['content']) && isset($_GET['id']) && !empty($_POST['content']) && !empty($_GET['id']) ) {

        $content = $_POST['content'];
        $post_id = $_GET['id'];
        $user_id = $_SESSION['user_id']; 
            
        $sql = 'INSERT INTO comments (content, post_id, user_id) VALUES (?, ?, ?)';
        $stmt = $connection->prepare($sql);
        $stmt->execute([$content, $post_id, $user_id]);
        header("Location: blog.php?success=comment_added");
    }
?>