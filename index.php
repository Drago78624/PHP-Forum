<?php 
    require "partials/_session_start.php";
  require "partials/_connection.php";
    require "partials/_categories.php";
  // print_r($categories);
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
    .category_card {
        transition: transform 300ms;
        cursor: pointer;
        border-width: 1px;
        border-style: solid;
    }

    .category_card:hover {
        transform: scale(1.02);
        border-color: darkgray;
    }
    </style>
    <title>Honolulu - Anime Forum</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require "partials/_header.php" ?>
    <?php if(isset($_GET['alert']) && $_GET['alert'] == true): ?>
    <div class="alert alert-<?php echo htmlspecialchars($_GET['clr'])?> my-0 alert-dismissible fade show" role="alert">
        <strong><?php echo htmlspecialchars($_GET['status']); ?>!</strong> <?php echo htmlspecialchars($_GET['msg']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img style="object-fit: cover;" src="imgs/s1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img style="object-fit: cover;" src="imgs/s2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img style="object-fit: cover;" src="imgs/s3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>
    <div class="container my-3">
        <h1 class="text-center my-3">
            <span class="text-warning">Honolulu</span> - Browse Categories
        </h1>
        <div class="container-fluid">
            <?php foreach($categories as $category => $val): ?>
            <a href="thread_list.php?cat_id=<?php echo $val['category_id']?>" class="text-dark text-decoration-none">
                <div class="card my-5 category_card">
                    <img style="width: 100%; height: 150px; object-fit:cover"
                        src="<?php echo 'https://source.unsplash.com/random/?coding,' . $val['category_name']?>"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($val['category_name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($val['category_description']); ?></p>
                        <a href="thread_list.php?cat_id=<?php echo $val['category_id']?>"
                            class="btn btn-warning my-2">Explore</a>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
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