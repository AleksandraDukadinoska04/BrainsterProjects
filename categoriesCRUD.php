<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== "administrator") {
    header('Location: index.php');
    return;
}

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/validationFunctions.php';

$errors = ['title' => false];

$add = true;
$action = 'create';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    switch ($_POST['action']) {
        case 'create':

            $title = trim($_POST['title']);

            if (requerdField($title)) {
                $errors['title'] = 'Title is requerd!';
                $add = false;
            }

            if ($add) {

                $info = ['title' => $title];

                $query = "INSERT INTO category (title) VALUES (:title)";
                $connObj->insert($query, $info);
            }

            break;

        case 'edit':

            $id = $_POST['id'];

            $query = "SELECT * FROM category WHERE id = :id";
            $category = $connObj->selectOne($query, [':id' => $id]);

            $action = 'update';

            break;

        case 'update':

            if (requerdField($_POST['title'])) {
                $errors['title'] = 'Title is requerd!';
                $add = false;
            }

            if ($add) {
                $info = [
                    'id' => trim($_POST['id']),
                    'title' => trim($_POST['title'])
                ];

                $query = "UPDATE category SET title = :title WHERE id = :id";
                $connObj->update($query, $info);
            }
            break;

        case 'delete':

            $info = [
                'id' => $_POST['id'],
                'is_deleted' => true
            ];

            $query = "UPDATE category SET is_deleted = :is_deleted WHERE id = :id";
            $connObj->update($query, $info);

            break;

        default:
            # code...
            break;
    }
}

$query = "SELECT * FROM category WHERE is_deleted = :is_deleted";
$categories = $connObj->selectAll($query, [':is_deleted' => 0]);


?>

<?php require_once __DIR__ . '/Partials/head.php' ?>


<body>
    <?php require_once __DIR__ . '/Partials/navbar.php' ?>

    <div class="container">
        <h1 class="text-center text-white my-5 fst-italic">ADD New Category</h1>
        <form action="" method="POST">
            <input type="hidden" name="action" value="<?= $action ?>">
            <?php if (isset($category)) { ?>
                <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <?php } ?>

            <div class="category mx-auto">
                <label for="title" class="labels">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter category's title..." value="<?= isset($category) ? $category['title'] : '' ?>" />
                <span class="validations d-block fw-bold"><?= $errors['title'] ? $errors['title'] : ''; ?></span>
                <button type="submit" class="bn5 d-block ms-auto my-2"><?= isset($category) ? 'EDIT' : 'ADD' ?></button>
            </div>


        </form>

    </div>


    <div class="container my-5">
        <h2 class="text-white m-0 w-100 border-bottom border-white pb-2 mb-4 fst-italic">ALL CATEGORIES</h2>
        <table class="table table-dark table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) { ?>
                    <tr class="">
                        <td scope="row"><?= $category['id'] ?></td>
                        <td><?= $category['title'] ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                <button type="submit" class="bn5 px-4 py-2 mx-1">Edit</button>
                            </form>
                            <form action="" method="POST">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                <button type="submit" class="bn5 mt-lg-1 px-3 py-2">Delete</button>
                            </form>
                        </td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>


    </div>

    <?php require_once __DIR__ . '/Partials/footer.php' ?>

    <!-- My JS -->
    <script src="JS/responsiveTable.js"></script>

</body>

</html>