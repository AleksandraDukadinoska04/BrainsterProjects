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



$errors = [
    'email' => false,
    'username' => false,
    'password' => false
];

$signup = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (requerdField($email)) {
        $errors['email'] = 'Email is requerd!';
        $signup = false;
    } elseif (invalidEmail($email)) {
        $errors['email'] = 'Invalid email! (ex.bob@example.com)';
        $signup = false;
    } elseif (emailTaken($users, $email)) {
        $errors['email'] = 'A user with this email already exists!';
        $signup = false;
    }

    if (requerdField($username)) {
        $errors['username'] = 'Username is requerd!';
        $signup = false;
    } elseif (usernameTaken($users, $username)) {
        $errors['username'] = 'Username is taken!';
        $signup = false;
    }


    if (requerdField($password)) {
        $errors['password'] = 'Password is requerd!';
        $signup = false;
    } elseif (passLength($password)) {
        $errors['password'] = 'Password is too short!';
        $signup = false;
    } elseif (passwordValidation($password)) {
        $errors['password'] = 'Password must have at least one number, one special sign and one uppercase letter!';
        $signup = false;
    }

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if ($signup) {

        $info = [
            'email' => $email,
            'username' => $username,
            'password' => $password
        ];

        $query = "INSERT INTO  users (email, username, password) VALUES (:email, :username, :password)";
        $connObj->insert($query, $info);

        header("Location: login.php");
        die;
    }
}


?>

<?php require_once __DIR__ . '/Partials/head.php' ?>

<body>

    <?php require_once __DIR__ . '/Partials/navbar.php' ?>


    <div class="container d-flex align-items-center justify-content-center vh-100 pt-3">
        <form action="" method="POST" class="form-block px-3 pb-1 px-md-4">
            <div class="row flex-wrap align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h1 class="my-4">SIGN UP</h1>
                </div>
                <div class="col-lg-8 col-12">
                    <div class=" my-3 text-center">
                        <input placeholder="Email..." required class="input d-block mx-auto w-100" name="email" type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                        <span class="validations d-block mx-auto fw-bold w-100"><?= $errors['email'] ? $errors['email'] : ''; ?></span>

                    </div>
                </div>

                <div class="col-lg-8 col-12">
                    <div class=" my-3 text-center">
                        <input placeholder="Username..." required class="input d-block mx-auto w-100" name="username" type="text" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
                        <span class="validations d-block mx-auto fw-bold w-100"><?= $errors['username'] ? $errors['username'] : ''; ?></span>

                    </div>
                </div>

                <div class="col-lg-8 col-12">

                    <div class=" my-3 text-center">
                        <input placeholder="Password..." required class="input d-block mx-auto w-100" name="password" type="password" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>">
                        <span class="validations d-block mx-auto fw-bold w-100"><?= $errors['password'] ? $errors['password'] : ''; ?></span>
                    </div>
                </div>

                <div class="col-lg-8 col-12 text-center">

                    <button type="submit" class="bn5 my-4">Submit!</button>

                    <span class="d-block fst-italic text-white mt-3">You have an account? <br> <a href="login.php" class="validations">Log In Here!</a></span>
                </div>

            </div>
        </form>
    </div>


    <?php require_once __DIR__ . '/Partials/footer.php' ?>

</body>

</html>