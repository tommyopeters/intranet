<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Useful Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="newpost.css">
    <!-- <link rel="stylesheet" href="homepage.css"> -->


    <title>Add new post</title>
</head>
<body>
    <div class="container main">
        <h1 class="header">Add new post</h1>
        <form action="">
            <div class="fgroup required">
                <label for="title">Post Title</label><br>
                <input class="title" name="title" type="text" placeholder="A new post">
            </div>
            <div class="fgroup required">
                <label for="content">Post Content</label><br>
                <textarea name="content" id="content" cols="100" rows="10" placeholder="Fill me with words..."></textarea>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="image">Upload an image</label><br>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input class="btn-secondary btn-sm btn" type="submit" name="submit" value="Upload">
            </form>
            <button class="btn btn-primary btn-sm" type="submit">Add Post</button>
        </form>
    </div>



<!-- Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>