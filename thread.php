<?php
    require "partials/_session_start.php";
    require "partials/_connection.php";
    require "partials/_categories.php";
    require "partials/_time-elapsed-function.php";

    $id = $_GET['thread_id'];
    $uid = $_GET['user_id'];
    if(isset($_SESSION['loggedin'])){
        $uidForComment = $_SESSION['user_id'];
    }
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $userSql = "SELECT * FROM `users` WHERE user_id = $uid";
    $userSqlResult = mysqli_query($conn, $userSql);
    $userRow = mysqli_fetch_assoc($userSqlResult);


    $commentPostAlert = false;
    if(isset($_POST['commentBtn'])){
        $comment_desc = $_POST['commentDesc'];

        $commentInsertSql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`) VALUES ('$comment_desc', '$id', '$uidForComment');";
        $commentInsertResult = mysqli_query($conn, $commentInsertSql);
        $commentPostAlert = true;
    }

    $commentSql = "SELECT * FROM `comments` WHERE thread_id = $id";
    $commentResult = mysqli_query($conn, $commentSql);
    $commentRow = mysqli_fetch_all($commentResult, MYSQLI_ASSOC);
    
    // print_r($commentRow);

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

    <title>Hello, world!</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require "partials/_header.php";  ?>
    <?php if($commentPostAlert): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your comment has been added successfuly
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <div class="container my-3">
        <div class="d-flex my-3 bg-light p-3 rounded thread-card">
            <div class="flex-shrink-0">
                <img class="rounded-circle" src="https://source.unsplash.com/random/60x60/?people" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
                <h4><?php echo htmlspecialchars($row['thread_title']) ?></h4>
                <p class="fs-5"><?php echo htmlspecialchars($row['thread_desc']) ?></p>
                <strong>Posted by : </strong>
                <?php echo htmlspecialchars($userRow['user_email']) ?>
            </div>
        </div>
    </div>
    <div class="container my-3">
        <h1 class="text-center">Add a comment</h1>
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" method="POST">
            <div class="mb-3">
                <label for="commentDesc" class="form-label">Type a comment</label>
                <textarea name="commentDesc" id="commentDesc" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-warning" name="commentBtn" value="commentAdded">Add comment</button>
        </form>
        <?php else: ?>
        <div class="alert alert-warning fs-4 text-center p-5" role="alert">
            You need to be logged in to comment
        </div>
        <?php endif; ?>
    </div>
    <div class="container my-3">
        <h1 class="text-center">Discussions</h1>
        <?php if($commentRow): ?>

        <?php foreach($commentRow as $commentlist => $comment): ?>
        <?php
                    $comment_id = $comment['comment_by'];
                    $commentorSql = "SELECT user_email FROM `users` WHERE user_id = $comment_id";
                    $commentorSqlResult = mysqli_query($conn, $commentorSql);
                    $commentorRow = mysqli_fetch_assoc($commentorSqlResult);
                    $commentorUsername = $commentorRow['user_email'];
                ?>
        <div class="d-flex my-3 bg-light p-3 rounded thread-card">
            <div class="flex-shrink-0">
                <img class="rounded-circle" src="https://source.unsplash.com/random/60x60/?people" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
                <div class="mb-2 d-flex align-items-center">
                    <h5 class="me-2 mb-0"><?php echo htmlspecialchars($commentorUsername) ?></h5> <span
                        class="muted"><?php echo time_elapsed_string($comment['timestamp']); ?></span>
                </div>
                <?php echo htmlspecialchars($comment['comment_content']) ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="alert alert-warning fs-4 text-center p-5" role="alert">
            <strong> No comments available !</strong> Be the first one to comment
        </div>
        <?php endif; ?>
    </div>
    <?php require "partials/_footer.php";  ?>

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