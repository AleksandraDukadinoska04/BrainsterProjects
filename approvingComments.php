<?php
session_start();

if (!isset($_GET['commentId']) || $_GET['commentId'] === '' || !isset($_GET['bookId']) || $_GET['bookId'] === '' || !isset($_SESSION['login']) || $_SESSION['role'] !== 'administrator') {
    header('Location: index.php');
    return;
}
require_once __DIR__ . '/autoload.php';

$commentId = $_GET['commentId'];
$bookId = $_GET['bookId'];

if (isset($_GET['status'])) {
    if ($_GET['status'] === 'approved') {
        $newValue = 'approved';
    } else if ($_GET['status'] === 'disapproved') {
        $newValue = 'disapproved';
    }

    $info = [
        'status' => $newValue,
        'commentId' => $commentId
    ];
    $query = "UPDATE bookcomments SET status = :status WHERE id = :commentId";
    $connObj->update($query, $info);
} else {
    $query = "SELECT * FROM bookcomments WHERE id = :id";
    $comment = $connObj->selectOne($query, [':id' => $commentId]);

    if ($comment['status'] === 'approved') {
        $newValue = 'disapproved';
    } else if ($comment['status'] === 'disapproved') {
        $newValue = 'approved';
    }

    $info = [
        'status' => $newValue,
        'commentId' => $commentId
    ];

    $query = "UPDATE bookcomments SET status = :status WHERE id = :commentId";
    $connObj->update($query, $info);
}
header("Location: book.php?id=$bookId");
die;
