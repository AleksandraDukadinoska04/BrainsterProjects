<?php
session_start();

if (!isset($_SESSION['login']) && $_SESSION['role'] !== 'user' || !isset($_SESSION['userId'])) {
    header('Location: index.php');
    die;
}

require_once __DIR__ . '/autoload.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $noteId = $_POST['id'];
    $noteContent = $_POST['content'];
    $userId = $_SESSION['userId'];

    $stmt = $connection->prepare('UPDATE notes SET content = :content WHERE id = :id AND user_id = :user_id');
    if ($stmt->execute(['content' => $noteContent, 'id' => $noteId, 'user_id' => $userId])) {
        echo json_encode(['status' => 'success']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error']);
    }
}
