<?php
session_start();

if (!isset($_SESSION['login']) && $_SESSION['role'] !== 'user' || !isset($_SESSION['userId'])) {
    header('Location: index.php');
    die;
}

require_once __DIR__ . '/autoload.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $noteContent = $_POST['note'];
    $bookId = $_POST['bookId'];
    $userId = $_SESSION['userId'];

    $stmt = $connection->prepare('INSERT INTO notes (user_id, book_id, content) VALUES (:user_id, :book_id, :content)');
    if ($stmt->execute(['user_id' => $userId, 'book_id' => $bookId, 'content' => $noteContent])) {
        echo json_encode(['status' => 'success']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error']);
    }
}
