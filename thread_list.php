<?php

use LDAP\Result;

    require "partials/_connection.php";
    require "partials/_categories.php";

    $id = $_GET['cat_id'];

    // inserting thread
    $threadPostAlert = false;
    if(isset($_POST['postBtn'])){
        $thread_title = $_POST['threadTitle'];
        $thread_desc = $_POST['threadDesc'];

        $threadInsertSql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ('$thread_title', '$thread_desc', '$id', '0');";
        $threadInsertResult = mysqli_query($conn, $threadInsertSql);
        $threadPostAlert = true;
    }
    
    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $threadSql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
    $threadResult = mysqli_query($conn, $threadSql);
    $threadRow = mysqli_fetch_all($threadResult, MYSQLI_ASSOC);

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    .thread-card {
        transition: transform 300ms;
        cursor: pointer;
        border-width: 1px;
        border-style: solid;
        border-color: white;
    }

    .thread-card:hover {
        transform: scale(1.02);
        border-color: darkgray;
    }
    </style>
    <title><?php echo htmlspecialchars($row['category_name']) ?> Forums</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require "partials/_header.php" ?>
    <?php if($threadPostAlert): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your thread has been posted successfuly , wait for the community to respond
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <div class="container my-3">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Welcome to <?php echo htmlspecialchars($row['category_name']) ?> Forums
                </h1>
                <p class="col-md-8 fs-4"><?php echo htmlspecialchars($row['category_description']) ?></p>
                <a class="btn btn-warning btn-lg" href="#threads">Read threads</a>
            </div>
        </div>
    </div>
    <div class="container my-3">

        <h1 class="text-center">Post a Thread</h1>
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" method="POST">
            <div class="mb-3">
                <label for="threadTitle" class="form-label">Title</label>
                <input type="text" class="form-control" name="threadTitle" id="threadTitle"
                    aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your title short</div>
            </div>
            <div class="mb-3">
                <label for="threadDesc" class="form-label">Description</label>
                <textarea name="threadDesc" id="threadDesc" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-warning" name="postBtn" value="threadPosted">Post</button>
        </form>
        <?php else: ?>
        <div class="alert alert-warning fs-4 text-center p-5" role="alert">
            You need to logged in to post a thread
        </div>
        <?php endif; ?>
    </div>
    <div class="container my-3" id="threads">
        <h1 class="text-center">Browse Threads</h1>
        <?php if($threadRow): ?>
        <?php foreach($threadRow as $threadlist => $thread): ?>
        <a href="thread.php?thread_id=<?php echo htmlspecialchars($thread['thread_id'])?>"
            class="text-dark text-decoration-none">
            <div class="d-flex my-3 bg-light p-3 rounded thread-card">
                <div class="flex-shrink-0">
                    <img class="rounded-circle" src="https://source.unsplash.com/random/60x60/?people" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5><?php echo htmlspecialchars($thread['thread_title']) ?></h5>
                    <?php echo htmlspecialchars($thread['thread_desc']) ?>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="alert alert-warning fs-4 text-center p-5" role="alert">
            <strong> No threads available !</strong> Be the first one to ask
        </div>
        <?php endif; ?>
    </div>

    <?php require "partials/_footer.php" ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>