<?php
session_start();
if (!isset($_SESSION['login']) && $_SESSION['role'] !== 'user' || !isset($_GET['bookId']) || !isset($_SESSION['userId'])) {
    header('Location: index.php');
    die;
}

require_once __DIR__ . '/autoload.php';

$userId = $_SESSION['userId'];
$bookId = $_GET['bookId'];


$query = 'SELECT id, content FROM notes WHERE user_id = :user_id AND book_id = :book_id';
$notes = $connObj->selectAll($query, ['user_id' => $userId, 'book_id' => $bookId]);

echo json_encode(['notes' => $notes]);
