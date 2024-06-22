<?php
session_start();

if (!isset($_GET['id']) || $_GET['id'] === "") {
    header('Location: index.php');
    return;
}

require_once __DIR__ . '/autoload.php';

$id = $_GET['id'];

$query = "SELECT * FROM book WHERE id = :id";
$book = $connObj->selectOne($query, [':id' => $id]);

if (!$book) {
    header('Location: index.php');
    return;
}

$errors = ['comment' => false];
$add = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $comment = trim($_POST['comment']);
    if (!$comment) {
        $errors['comment'] = 'Write some comment!';
        $add = false;
    }

    if ($add) {

        $info = [
            'book_id' => $_GET['id'],
            'user_id' => $_SESSION['userId'],
            'comment' => $comment
        ];

        $query = "INSERT INTO  bookcomments (book_id, user_id, comment) VALUES (:book_id, :user_id, :comment)";
        $connObj->insert($query, $info);
    }
}

$query = "SELECT b.id, b.title, CONCAT(a.firstname,' ', a.lastname) as author, a.biography, b.publication_year, b.number_of_pages, b.image, c.title as category FROM book b JOIN author a ON b.author_id=a.id JOIN category c ON b.category_id=c.id WHERE b.id = :id";
$result = $connObj->selectOne($query, [':id' => $id]);

$query = "SELECT * FROM bookcomments c JOIN users u ON c.user_id=u.id WHERE c.book_id = :id AND c.status = :status";
$approvedComments = $connObj->selectAll($query, [':id' => $id, 'status' => 'approved']);

$query = "SELECT c.id, c.book_id, c.user_id, c.comment,c.status, u.email, u.username FROM bookcomments c JOIN users u ON c.user_id=u.id WHERE c.book_id = :id";
$allComments = $connObj->selectAll($query, [':id' => $id]);


if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
    $query = "SELECT * FROM bookcomments WHERE user_id = :user_id AND book_id = :book_id";
    $userComment = $connObj->selectOne($query, [':book_id' => $_GET['id'], ':user_id' => $_SESSION['userId']]);
}


?>

<?php require_once __DIR__ . '/Partials/head.php' ?>

<body>
    <?php require_once __DIR__ . '/Partials/navbar.php' ?>


    <div class="container d-flex align-items-center justify-content-center my-5 ">

        <div class="wrap row">
            <div class="col-11 col-md-4 ms-lg-auto ms-md-0 mx-auto">
                <section id="card1" class="card">
                    <img src="<?= $result['image'] ?>" alt="">
                    <div class="card__content">
                        <p class="card__title"><?= $result['title'] ?></p>
                        <p class="card__description">
                        <p>Author: <b><?= $result['author'] ?></b></p>
                        <p>Category: <b><?= $result['category'] ?></b></p>
                        <p>Publication year: <b><?= $result['publication_year'] ?></b></p>
                        <p>Number of pages: <b><?= $result['number_of_pages'] ?></b></p>
                        </p>
                    </div>
                </section>
            </div>

            <div class="col-11 col-md-8 mx-auto mx-md-0 ms-md-auto p-0 ps-lg-2 text">
                <div>
                    <h2 class="synopsis_title mt-3 mt-md-0">SYNOPSIS</h2>
                    <p class="synopsis">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas excepturi quibusdam, nobis esse et deleniti voluptatem quam impedit quasi aliquid repellendus sed? Magnam ea ipsa corporis harum, numquam, consequatur in adipisci eius natus suscipit sed tempore temporibus consequuntur itaque fugiat eos placeat at repellendus tenetur eligendi facilis facere? Tempore dignissimos quasi qui eaque nam ullam mollitia maiores cum quidem possimus!</p>
                </div>
                <div>
                    <h2 class="synopsis_title">About <?= $result['author'] ?></h2>
                    <p class="synopsis"><?= $result['biography'] ?></p>
                </div>

            </div>

        </div>
    </div>


    <?php if (isset($_SESSION['login']) && $_SESSION['role'] === 'user') { ?>
        <div class="container">
            <h2 for="note" class="subtitle">Leave a Note for the Book</h2>
            <form id="noteForm" class="d-flex flex-wrap align-items-center">
                <textarea id="noteContent" name="note" required placeholder="Write some note..." class="input d-block"></textarea>
                <input type="hidden" id="bookId" name="bookId" value="<?= $_GET['id'] ?>">
                <input type="hidden" id="noteId" name="noteId">
                <button type="button" id="submitNoteBtn" class="bn5 mx-lg-2 mx-md-2">Submit Note</button>
            </form>
            <div id="notesContainer" class="d-flex flex-wrap justify-content-center align-items-center"></div>
        </div>

    <?php }  ?>



    <?php if (isset($_SESSION['login']) && $_SESSION['role'] === 'user') { ?>
        <div class="container my-5">
            <h2 class="subtitle">Your Comment</h2>
            <?php if ($userComment) { ?>
                <div class="d-flex flex-wrap align-items-center justify-content-start">
                    <p class="comment m-0"><?= $userComment['comment'] ?></p>
                    <span class="text-white mx-lg-3 me-2 text-capitalize"><?= $userComment['status'] ?></span>
                    <a href="deleteComment.php?commentId=<?= $userComment['id'] ?>&bookId=<?= $_GET['id'] ?>" class="bn5 my-md-2">Delete</a>
                </div>

            <?php } else { ?>
                <form action="" method="POST">
                    <div class="d-flex flex-wrap justify-content-start align-items-start">
                        <div class="leaveComment">
                            <textarea name="comment" id="comment" class="input w-100" placeholder="Add a comment..."></textarea>
                            <span class="validations d-block fw-bold "><?= $errors['comment'] ? $errors['comment'] : ''; ?></span>
                        </div>
                        <button type="submit" class="bn5 mx-lg-2 mx-md-2">Comment</button>
                    </div>

                </form>
            <?php }  ?>

            <div class="comments container my-5 p-0">
                <h2 class="text-white mx-0 w-100 border-bottom border-white pb-2">Comments</h2>
                <?php if (count($approvedComments) > 0) { ?>
                    <?php foreach ($approvedComments as $comment) { ?>
                        <div class="my-4">
                            <p class="username"><?= $comment['username'] ?></p>
                            <p class="comment m-0"><?= $comment['comment'] ?></p>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p>No comments yet...</p>
                <?php } ?>
            </div>
        </div>

    <?php } else if (isset($_SESSION['login']) && $_SESSION['role'] === 'administrator') { ?>
        <div class="comments container">
            <div class="d-flex align-items-end justify-content-between border-bottom border-white pb-2 mb-4 w-100">

                <h2 class="text-white mx-0 mb-0">Comments</h2>

                <div class="d-flex flex-wrap ms-5">
                    <div class="me-2 me-md-0 me-lg-0">
                        <label for="approved" class="commentFilter">Approved</label>
                        <i class="fa-solid fa-xmark"></i>
                        <input type="checkbox" id="approved" name="approved" checked>
                        <i class="fa-solid fa-check"></i>
                    </div>

                    <div class="me-2 mx-md-4 mx-lg-4">
                        <label for="notApproved" class="commentFilter">Dispproved</label>
                        <i class="fa-solid fa-xmark"></i>
                        <input type="checkbox" id="notApproved" name="notApproved" checked>
                        <i class="fa-solid fa-check"></i>
                    </div>

                    <div class="">
                        <label for="pending" class="commentFilter">Pending</label>
                        <i class="fa-solid fa-xmark"></i>
                        <input type="checkbox" id="pending" name="pending" checked>
                        <i class="fa-solid fa-check"></i>
                    </div>
                </div>
            </div>
            <?php if (count($allComments) > 0) { ?>
                <?php foreach ($allComments as $comment) { ?>
                    <?php if ($comment['status'] === 'pending') { ?>
                        <div class="<?= $comment['status'] ?>">
                            <p class="username"><?= $comment['username'] ?></p>
                            <div class="d-flex flex-wrap align-items-center justify-content-start mb-4">
                                <p class="comment m-0"><?= $comment['comment'] ?></p>
                                <span class="text-white me-2 mx-lg-3 text-capitalize"><?= $comment['status'] ?></span>
                                <a href="./approvingComments.php?commentId=<?= $comment['id'] ?>&bookId=<?= $_GET['id'] ?>&status=approved" class="bn5 my-md-2 px-2 me-3">Approve</a>
                                <a href="./approvingComments.php?commentId=<?= $comment['id'] ?>&bookId=<?= $_GET['id'] ?>&status=disapproved" class="bn5 my-md-2 px-3">Disapprove</a>

                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="<?= $comment['status'] === "approved" ? "approved" : "notApproved" ?>">
                            <p class="username"><?= $comment['username'] ?></p>
                            <div class="d-flex flex-wrap align-items-center justify-content-start mb-4">
                                <p class="comment m-0"><?= $comment['comment'] ?></p>
                                <span class="text-white me-2 mx-lg-3"><?= $comment['status'] === "approved" ? "Approved" : "Disapproved" ?></span>
                                <a href="./approvingComments.php?commentId=<?= $comment['id'] ?>&bookId=<?= $_GET['id'] ?>" class="bn5 my-md-2"> <?= $comment['status'] === "disapproved" ? "Approve" : "Disapprove" ?></a>
                            </div>
                        </div>
                    <?php } ?>

                <?php } ?>
            <?php } else { ?>
                <p>No comments yet...</p>
            <?php } ?>
        </div>

    <?php } else { ?>
        <div class="comments container my-5 px-2 mx-auto ">
            <h2 class="text-white mx-0 w-100 border-bottom border-white pb-2">Comments</h2>
            <?php if (count($approvedComments) > 0) { ?>

                <?php foreach ($approvedComments as $comment) { ?>
                    <div class="my-4">
                        <p class="username"><?= $comment['username'] ?></p>
                        <p class="comment m-0"><?= $comment['comment'] ?></p>
                    </div>
                <?php } ?>

            <?php } else { ?>
                <p>No comments yet...</p>
            <?php } ?>
        </div>
    <?php }  ?>


    <?php require_once __DIR__ . '/Partials/footer.php' ?>

    <!-- My JS -->
    <script src="JS/commentsFilter.js"></script>
    <script src="JS/notesAJAX.js"></script>

</body>

</html>