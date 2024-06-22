<?php

session_start();

require_once __DIR__ . '/autoload.php';

$query = "SELECT b.id, b.title, CONCAT(a.firstname,' ', a.lastname) as author, b.publication_year, b.number_of_pages, b.image, c.title as category FROM book b JOIN author a ON b.author_id=a.id JOIN category c ON b.category_id=c.id WHERE a.is_deleted = 0 AND c.is_deleted = 0";
$books = $connObj->selectAll($query);

$query = "SELECT * FROM category";
$categories = $connObj->selectAll($query);


?>



<?php require_once __DIR__ . '/Partials/head.php' ?>

<body>

  <?php require_once __DIR__ . '/Partials/navbar.php' ?>


  <div class="banner text-center d-flex flex-column align-items-center justify-content-center">
    <div class="column d-flex align-items-center justify-content-center p-0">
      <div class="heart-container animate__animated animate__fadeIn">
        <img src="https://as1.ftcdn.net/v2/jpg/07/06/39/80/1000_F_706398043_ql5HP1ZyLB0FsBM58R5bZRVYe8LiuwzC.jpg" alt="Heart Shaped Image" class="heart-image">
      </div>
      <div class="inner">

        <p class="paragraph animate__animated animate__fadeIn">i have always imagened paradise to be a kind of</p>

        <h1 class="bannerTitle animate__animated animate__fadeIn">LIBRARY.</h1>
      </div>
    </div>
    <a href="#categories" id="categories"><i class="fa-solid fa-caret-down fa-beat arrow "></i></a>

  </div>

  <div class="text-center mb-5">
    <div class="row justify-content-evenly">
      <?php foreach ($categories as  $category) { ?>

        <?php if (!$category['is_deleted']) { ?>
          <div class="col-lg-2 col-4 col-md-2 filters">
            <label for="<?= $category['title'] ?>" class="filterLabel"><?= $category['title'] ?></label>
            <input type="checkbox" id="<?= $category['title'] ?>" class="categoryFilter" checked>
            <i class="fa-solid fa-circle-check"></i>
          </div>
        <?php } ?>
      <?php } ?>

    </div>
  </div>


  <div class="bookContainer my-5 d-flex align-items-center justify-content-center flex-wrap">

    <?php foreach ($books as  $book) { ?>

      <a href="book.php?id=<?= $book['id'] ?>" class="bookCard" id="<?= $book['category'] ?>">

        <img src="<?= $book['image'] ?>" alt="<?= $book['title'] ?>" class="image w-100">
        <div class="hoverDiv">
          <h3 class="bookTitle"><?= $book['title'] ?></h3>
          <span class="bookCategory"><?= $book['category'] ?></span>
          <p class="bookAuthor"><?= $book['author'] ?></p>
        </div>

      </a>

    <?php } ?>

  </div>



  <?php require_once __DIR__ . '/Partials/footer.php' ?>

  <!-- My JS -->
  <script src="JS/categoryFilters.js"></script>
  <script src="JS/bookHover.js"></script>

</body>

</html>