<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== "administrator") {
    header('Location: index.php');
    return;
}

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/validationFunctions.php';


$errors = [
    'title' => false,
    'author' => false,
    'publicationYear' => false,
    'numberOFpages' => false,
    'image' => false,
    'category' => false
];

$add = true;
$action = 'create';

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    switch ($_POST['action']) {
        case 'create':

            require_once __DIR__ . '/bookValidation.php';

            if ($add) {

                $info = [
                    'title' => $title,
                    'author_id' => $author,
                    'publication_year' => $publicationYear,
                    'number_of_pages' => $numberOFpages,
                    'image' => $image,
                    'category_id' => $category
                ];

                $query = "INSERT INTO book (title, author_id, publication_year, number_of_pages, image, category_id) VALUES (:title, :author_id, :publication_year, :number_of_pages, :image, :category_id)";
                $connObj->insert($query, $info);
            }

            break;
        case 'edit':

            $id = $_POST['id'];

            $query = "SELECT * FROM book WHERE id = :id";
            $book = $connObj->selectOne($query, [':id' => $id]);

            $action = 'update';

            break;
        case 'update':

            require_once __DIR__ . '/bookValidation.php';

            if ($add) {
                $info = [
                    'id' => $_POST['id'],
                    'title' => $title,
                    'author_id' => $author,
                    'publication_year' => $publicationYear,
                    'number_of_pages' => $numberOFpages,
                    'image' => $image,
                    'category_id' => $category
                ];

                $query = "UPDATE book SET title = :title, author_id = :author_id, publication_year = :publication_year, number_of_pages = :number_of_pages, image = :image, category_id = :category_id WHERE id = :id";
                $connObj->update($query, $info);
            }

            break;

        case 'delete':
            $id = $_POST['id'];

            $query = "DELETE FROM book WHERE id = :id";
            $connObj->delete($query, [':id' => $id]);

            break;
        default:
            # code...
            break;
    }
}


$query = "SELECT b.id, b.title, CONCAT(a.firstname,' ', a.lastname) as author, b.publication_year, b.number_of_pages, b.image, c.title as category FROM book b JOIN author a ON b.author_id=a.id JOIN category c ON b.category_id=c.id;";
$books = $connObj->selectAll($query);

$query = "SELECT * FROM category WHERE is_deleted = 0";
$categories = $connObj->selectAll($query);

$query = "SELECT id, CONCAT(firstname,' ',lastname) as name FROM author WHERE is_deleted = 0";
$authors = $connObj->selectAll($query);

?>

<?php require_once __DIR__ . '/Partials/head.php' ?>

<body>
    <?php require_once __DIR__ . '/Partials/navbar.php' ?>


    <div class="container">
        <h1 class="text-center text-white my-5 fst-italic">ADD New Book</h1>
        <form action="" method="POST">
            <?php if (isset($book)) { ?>
                <input type="hidden" name="id" value="<?= $book['id'] ?>">
            <?php } ?>
            <input type="hidden" name="action" value="<?= $action ?>">

            <div class="row flex-wrap g-4">
                <div class="col-md-6 col-12">
                    <div class="">
                        <label for="title" class="form-label labels">Title</label>
                        <input type="text" required name="title" id="title" class="form-control" placeholder="Enter book title.." value="<?= isset($book) ? $book['title'] : '' ?>" />
                        <span class="validations d-block fw-bold"><?= $errors['title'] ? $errors['title'] : ''; ?></span>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="">
                        <label for="author" class="form-label labels">Author</label>
                        <select name="author" id="author" class="form-select" required>
                            <option value="" selected disabled>Choose author...</option>
                            <?php foreach ($authors as $author) { ?>
                                <option value="<?= $author['id'] ?>" <?= isset($book) && $author['id'] === $book['author_id'] ? 'selected' : '' ?>><?= $author['name'] ?></option>
                            <?php } ?>

                        </select>

                        <span class="validations d-block fw-bold"><?= $errors['author'] ? $errors['author'] : ''; ?></span>

                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="">
                        <label for="publicationYear" class="form-label labels">Publication year</label>
                        <input type="number" required name="publicationYear" id="publicationYear" class="form-control" placeholder="Enter publication year of the book.." value="<?= isset($book) ? $book['publication_year'] : '' ?>" />

                        <span class="validations d-block fw-bold"><?= $errors['publicationYear'] ? $errors['publicationYear'] : ''; ?></span>

                    </div>

                </div>
                <div class="col-md-6 col-12">
                    <div class="">
                        <label for="numberOFpages" class="form-label labels">Number of pages</label>
                        <input type="number" required name="numberOFpages" id="numberOFpages" class="form-control" placeholder="Enter number of pages of the book.." value="<?= isset($book) ? $book['number_of_pages'] : '' ?>" />

                        <span class="validations d-block fw-bold"><?= $errors['numberOFpages'] ? $errors['numberOFpages'] : ''; ?></span>

                    </div>

                </div>
                <div class="col-md-6 col-12">
                    <div class="">
                        <label for="imageURL" class="form-label labels">Image URL</label>
                        <input type="text" required name="imageURL" id="imageURL" class="form-control" placeholder="Enter image URL for the book.." value="<?= isset($book) ? $book['image'] : '' ?>" />

                        <span class="validations d-block fw-bold"><?= $errors['image'] ? $errors['image'] : ''; ?></span>

                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="">
                        <label for="category" class="form-label labels">Category</label>
                        <select name="category" id="category" class="form-select" required>
                            <option value="" selected disabled>Choose category...</option>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?= $category['id'] ?>" <?= isset($book) && $category['id'] === $book['category_id'] ? 'selected' : '' ?>><?= $category['title'] ?></option>
                            <?php } ?>

                        </select>

                        <span class="validations d-block fw-bold"><?= $errors['category'] ? $errors['category'] : ''; ?></span>

                    </div>
                </div>

                <div class="col-12 col-md-6 offset-md-6">
                    <button type="submit" class="bn5 w-100"><?= isset($book) ? 'EDIT' : 'ADD' ?></button>
                </div>
            </div>
        </form>

    </div>



    <div class="container my-4">
        <h2 class="text-white m-0 w-100 border-bottom border-white pb-2 mb-4 fst-italic">ALL BOOKS</h2>
        <table class="table table-dark table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Pub.year</th>
                    <th scope="col">Pages</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book) { ?>
                    <tr class="">
                        <td scope="row"><?= $book['id'] ?></td>
                        <td><?= $book['title'] ?></td>
                        <td><?= $book['author'] ?></td>
                        <td><?= $book['publication_year'] ?></td>
                        <td><?= $book['number_of_pages'] ?></td>
                        <td class="imageURL"><span class="ms-3 ms-lg-0"><?= $book['image'] ?></span></td>
                        <td><?= $book['category'] ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="<?= $book['id'] ?>">
                                <button type="submit" class="bn5 px-4 py-2 mx-1 mx-md-0">Edit</button>
                            </form>
                            <form action="" method="POST" id="deleteForm">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $book['id'] ?>">
                                <button type="submit" class="bn5 mt-lg-1 px-3 py-2" id="deleteBtn">Delete</button>
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>

    <?php require_once __DIR__ . '/Partials/footer.php' ?>

    <!-- My JS -->
    <script src="JS/deleteBookAlert.js"></script>
    <script src="JS/responsiveTable.js"></script>

</body>

</html>