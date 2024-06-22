<?php
session_start();

if (!isset($_GET['commentId']) || $_GET['commentId'] === '' || !isset($_GET['bookId']) || $_GET['bookId'] === '' || !isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
    header('Location: index.php');
    return;
}

require_once __DIR__ . '/autoload.php';

$commentId = $_GET['commentId'];
$bookId = $_GET['bookId'];

$query = "DELETE FROM bookcomments WHERE id = :id";
$connObj->delete($query, [':id' => $commentId]);

header("Location: book.php?id=$bookId");
die;
