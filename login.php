<?php
session_start();

if (isset($_SESSION['login'])) {
    header('Location: index.php');
    return;
}

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/validationFunctions.php';

$query = "SELECT * FROM users";
$users = $connObj->selectAll($query);


$errors = ['email' => false, 'password' => false];
$login = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (requerdField($email)) {
        $errors['email'] = 'Email is requerd!';
        $signup = false;
    } elseif (invalidEmail($email)) {
        $errors['email'] = 'Invalid email! (ex.bob@example.com)';
        $signup = false;
    }

    if (requerdField($password)) {
        $errors['password'] = 'Password is requerd!';
        $login = false;
    } elseif (passLength($password)) {
        $errors['password'] = 'Password is too short!';
        $login = false;
    } elseif (passwordValidation($password)) {
        $errors['password'] = 'Password must have at least one number, one special sign and one uppercase letter!';
        $login = false;
    }


    if ($login) {

        $user = checkUser($users, $email, $password);

        if ($user) {
            if ($user['role'] === 'administrator') {
                $_SESSION['login'] = true;
                $_SESSION['role'] = 'administrator';
            } else if ($user['role'] === 'user') {
                $_SESSION['login'] = true;
                $_SESSION['role'] = 'user';
                $_SESSION['userId'] = $user['id'];
            }

            header("Location: index.php");
            die;
        } else {
            $errors['password'] = 'Wrong username/password combination!';
            $errors['email'] = 'Wrong username/password combination!';
        }
    }
}
?>

<?php require_once __DIR__ . '/Partials/head.php' ?>

<body>

    <?php require_once __DIR__ . '/Partials/navbar.php' ?>


    <div class="container d-flex align-items-center justify-content-center vh-100 ">
        <form action="" method="POST" class="form-block px-md-4 px-3 pb-1">
            <div class="row flex-wrap align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h1 class="my-4">LOG IN</h1>
                </div>
                <div class="col-lg-7 col-12">
                    <div class=" my-4 text-center">
                        <input placeholder="Email..." required class="input d-block mx-auto w-100" name="email" type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                        <span class="validations d-block mx-auto fw-bold w-100"><?= $errors['email'] ? $errors['email'] : ''; ?></span>

                    </div>
                </div>

                <div class="col-lg-7 col-12">

                    <div class=" my-4 text-center">
                        <input placeholder="Password..." required class="input d-block mx-auto w-100" name="password" type="password" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>">
                        <span class="validations d-block mx-auto fw-bold w-100"><?= $errors['password'] ? $errors['password'] : ''; ?></span>
                    </div>
                </div>

                <div class="col-lg-8 col-12 text-center">

                    <button type="submit" class="bn5 my-4">Submit!</button>

                    <span class="d-block fst-italic text-white mt-3">You don't have an account? <br> <a href="signup.php" class="validations">Sing Up Here!</a></span>
                </div>

            </div>
        </form>
    </div>


    <?php require_once __DIR__ . '/Partials/footer.php' ?>


</body>

</html>