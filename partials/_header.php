<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand text-warning fs-4">Honoululu</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
                    <div class="dropdown-menu">
                        <?php foreach($categories as $category => $val): ?>
                        <a href="thread_list.php?cat_id=<?php echo htmlspecialchars($val['category_id'])?>"
                            class="dropdown-item"><?php echo htmlspecialchars($val['category_name']) ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
            <form class="d-flex">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <button type="button" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></button>
                </div>
            </form>
            <div class="navbar-nav flex align-items-center">
                <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                <span class="text-light mx-3 d-inline-block">Welcome,
                    <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="partials/_logout.php" class="nav-item btn btn-warning">Logout</a>
                <?php else: ?>
                <a href="#" class="nav-item nav-link mx-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                <a href="#" class="nav-item btn btn-warning" data-bs-toggle="modal" data-bs-target="#signupModal">Sign
                    up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<?php 
    require "_loginModal.php";
    require "_signupModal.php";
?>