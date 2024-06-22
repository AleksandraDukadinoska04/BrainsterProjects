<?php

$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$biography = trim($_POST['biography']);

if (requerdField($firstname)) {
    $errors['firstname'] = 'Firstname is requerd!';
    $add = false;
}

if (requerdField($lastname)) {
    $errors['lastname'] = 'Lastname is requerd!';
    $add = false;
}

if (requerdField($biography)) {
    $errors['biography'] = 'Biography is requerd!';
    $add = false;
} elseif (strlen($biography) < 20) {
    $errors['biography'] = 'Biography must have at least 20 chars!';
    $add = false;
}
