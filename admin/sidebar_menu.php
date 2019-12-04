

<?php
    $page = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
    <a href="../index.php" >Circle</a>
    <a href="index.php" <?php if($page == 'index.php'){ echo 'class="active"';} ?>>Home</a>
    <a href="users.php" <?php if($page == 'users.php'){ echo 'class="active"';} ?>>Users</a>
    <a href="admin.php" <?php if($page == 'admin.php'){ echo 'class="active"';} ?>>Admin</a>
    <a href="blog.php" <?php if($page == 'blog.php'){ echo 'class="active"';} ?>>Blog</a>
    <a href="posts.php" <?php if($page == 'posts.php'){ echo 'class="active"';} ?>>Posts</a>
    <a href="logout.php" data-toggle="modal" data-target="#logoutmodal">LOG OUT</a>
</div>