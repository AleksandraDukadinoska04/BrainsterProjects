<?php
$title = trim($_POST['title']);
$numberOFpages = trim($_POST['numberOFpages']);
$publicationYear = trim($_POST['publicationYear']);
$image = trim($_POST['imageURL']);

if (isset($_POST['author'])) {
    $query = "SELECT * FROM author WHERE id = :author";
    $author = $connObj->selectOne($query, ['author' => $_POST['author']]);
}
if (isset($_POST['category'])) {
    $query = "SELECT * FROM category WHERE id = :category";
    $category = $connObj->selectOne($query, ['category' => $_POST['category']]);
}


if (requerdField($title)) {
    $errors['title'] = 'Title is requerd!';
    $add = false;
}

if (!isset($_POST['author'])) {
    $errors['author'] = 'Author is requerd!';
    $add = false;
} elseif (!$author || !is_numeric($_POST['author']) || $_POST['author'] <= 0) {
    $errors['author'] = 'Please choose from the given authors!';
    $add = false;
} else {
    $author = trim($_POST['author']);
}

if (requerdField($publicationYear)) {
    $errors['publicationYear'] = 'Publication year is requerd!';
    $add = false;
} elseif (!is_numeric($publicationYear)) {
    $errors['publicationYear'] = 'Please enter valid publication year!';
    $add = false;
} elseif (strlen($publicationYear) !== 4 || $publicationYear <= 0) {
    $errors['publicationYear'] = 'Please enter valid publication year!';
    $add = false;
}

if (requerdField($numberOFpages)) {
    $errors['numberOFpages'] = 'Number of pages is requerd!';
    $add = false;
} else if ($numberOFpages <= 0 || !is_numeric($numberOFpages)) {
    $errors['numberOFpages'] = 'Number of pages is requerd!';
    $add = false;
}

if (requerdField($image)) {
    $errors['image'] = 'Image is requerd!';
    $add = false;
} elseif (!imageValidation($image)) {
    $errors['image'] = 'Invalid image URL!';
    $add = false;
}

if (!isset($_POST['category'])) {
    $errors['category'] = 'Category is requerd!';
    $add = false;
} elseif (!$category || !is_numeric($_POST['category']) || $_POST['category'] <= 0) {
    $errors['category'] = 'Please choose from the given categories!';
    $add = false;
} else {
    $category = trim($_POST['category']);
}
