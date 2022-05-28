<?php 
    require "partials/_session_start.php";
    require "partials/_connection.php";
    require "partials/_categories.php";
    require "partials/_time-elapsed-function.php";
  // print_r($categories);
    $searchedItem = $_GET['search-result'];
    $sql = "SELECT * FROM `threads` WHERE MATCH (`thread_title`, `thread_desc`) against ('$searchedItem')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // print_r($row);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
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
    <title>Honolulu - Anime Forum</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require "partials/_header.php" ?>

    <div class="container my-3">
        <h1 class="text-center my-3">
            Search results for - <em>"<?php echo htmlspecialchars($_GET['search-result']) ?>"</em>
        </h1>
        <div class="container-fluid">
            <?php if($row): ?>
            <?php foreach($row as $searchedThread => $thread): ?>
            <a href="thread.php?thread_id=<?php echo htmlspecialchars($thread['thread_id'])?>&user_id=<?php echo htmlspecialchars($thread['thread_user_id'])?>"
                class="text-dark text-decoration-none">
                <div class="d-flex my-3 bg-light p-3 rounded thread-card">
                    <div class="flex-shrink-0">
                        <img class="rounded-circle" src="https://source.unsplash.com/random/60x60/?people" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="mb-2 d-flex align-items-center">
                            <h5 class="me-2 mb-0"><?php echo htmlspecialchars($thread['thread_title']) ?></h5> <span
                                class="muted"><?php echo time_elapsed_string($thread['timestamp']); ?></span>
                        </div>
                        <?php echo htmlspecialchars($thread['thread_desc']) ?>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="alert alert-warning fs-4 text-center p-5" role="alert">
                <strong> No threads available according to your query !
            </div>
            <?php endif; ?>
        </div>
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