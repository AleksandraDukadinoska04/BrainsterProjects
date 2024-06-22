<nav class="navbar sticky-top navbar-expand-lg p-lg-0 p-md-1">
    <div class="container-fluid ">
        <a class="navbar-brand text-white" href="index.php"><img src="./Images/logo.png" alt="logo" class="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if (isset($_SESSION['login']) && $_SESSION['role'] === 'administrator') { ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="booksCRUD.php">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="authorsCRUD.php">Authors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="categoriesCRUD.php">Categories</a>
                    </li>
                </ul>
            <?php } ?>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION['login'])) { ?>
                    <a href="logout.php" class="btn btn-outline-light m-2">LOG OUT</a>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="login.php" class="btn btn-outline-light mx-lg-2 my-lg-0 my-2">LOG IN</a>
                    </li>

                <?php } ?>
            </ul>
        </div>
    </div>
</nav>