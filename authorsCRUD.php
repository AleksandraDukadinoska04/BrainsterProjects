<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== "administrator") {
    header('Location: index.php');
    return;
}

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/validationFunctions.php';



$errors = [
    'firstname' => false,
    'lastname' => false,
    'biography' => false,
];

$add = true;
$action = 'create';


if ($_SERVER['REQUEST_METHOD'] == "POST") {


    switch ($_POST['action']) {
        case 'create':

            require_once __DIR__ . '/authorsValidation.php';

            if ($add) {
                $info = [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'biography' => $biography
                ];

                $query = "INSERT INTO author (firstname, lastname, biography) VALUES (:firstname, :lastname, :biography)";
                $connObj->insert($query, $info);
            }


            break;

        case 'edit':

            $id = $_POST['id'];

            $query = "SELECT * FROM author WHERE id = :id";
            $author = $connObj->selectOne($query, [':id' => $id]);

            $action = 'update';

            break;

        case 'update':

            require_once __DIR__ . '/authorsValidation.php';

            if ($add) {
                $info = [
                    'id' => $_POST['id'],
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'biography' => $biography
                ];
                $query = "UPDATE author SET firstname = :firstname, lastname = :lastname, biography = :biography WHERE id = :id";
                $connObj->update($query, $info);
            }

            break;

        case 'delete':

            $info = [
                'id' => $_POST['id'],
                'is_deleted' => true
            ];

            $query = "UPDATE author SET is_deleted = :is_deleted WHERE id = :id";
            $connObj->update($query, $info);

            break;

        default:
            # code...
            break;
    }
}


$query = "SELECT * FROM author WHERE is_deleted = :is_deleted";
$authors = $connObj->selectAll($query, [':is_deleted' => 0]);

?>

<?php require_once __DIR__ . '/Partials/head.php' ?>

<body>
    <?php require_once __DIR__ . '/Partials/navbar.php' ?>


    <div class="container">
        <h1 class="text-center text-white my-5 fst-italic">ADD New Author</h1>
        <form action="" method="POST">
            <input type="hidden" name="action" value="<?= $action ?>">
            <?php if (isset($author)) { ?>
                <input type="hidden" name="id" value="<?= $author['id'] ?>">
            <?php } ?>

            <div class="row flex-wrap g-4">
                <div class="col-md-6 col-12">
                    <div class="">
                        <label for="firstname" class="labels">Firstname</label>
                        <input type="text" name="firstname" required id="firstname" class="form-control" placeholder="Enter author's firstname..." value="<?= isset($author) ? $author['firstname'] : '' ?>" />
                        <span class="validations d-block fw-bold"><?= $errors['firstname'] ? $errors['firstname'] : ''; ?></span>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="">
                        <label for="lastname" class="labels">Lastname</label>
                        <input type="text" required name="lastname" id="lastname" class="form-control" placeholder="Enter author's lastname..." value="<?= isset($author) ? $author['lastname'] : '' ?>" />
                        <span class="validations d-block fw-bold"><?= $errors['lastname'] ? $errors['lastname'] : ''; ?></span>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="">
                        <label for="biography" class="labels">Biography</label>
                        <textarea name="biography" required id="biography" class="form-control" placeholder="Enter author's biography..."><?= isset($author) ? $author['biography'] : '' ?></textarea>
                        <span class="validations d-block fw-bold"><?= $errors['biography'] ? $errors['biography'] : ''; ?></span>
                    </div>
                </div>
                <div class="col-md-6 col-12 d-flex justify-content-center align-items-center">
                    <button type="submit" class="bn5 w-100"><?= isset($author) ? 'EDIT' : 'ADD' ?></button>

                </div>
            </div>
        </form>

    </div>


    <div class="container my-5">
        <h2 class="text-white m-0 w-100 border-bottom border-white pb-2 mb-4 fst-italic">ALL AUTHORS</h2>
        <table class="table table-dark table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Biography</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($authors as $author) { ?>

                    <tr class="">
                        <td scope="row"><?= $author['id'] ?></td>
                        <td><?= $author['firstname'] ?></td>
                        <td><?= $author['lastname'] ?></td>
                        <td><?= $author['biography'] ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="<?= $author['id'] ?>">
                                <button type="submit" class="bn5 px-4 py-2 mx-1">Edit</button>
                            </form>
                            <form action="" method="POST">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $author['id'] ?>">
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