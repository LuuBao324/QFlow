<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

$title = 'Recent Questions';

try {
    $stmt = $pdo->prepare("SELECT questions.*, users.username FROM questions JOIN users ON questions.user_id = users.id ORDER BY created_at DESC");
    $stmt->execute();
    $questions = $stmt->fetchAll();

    ob_start();
    include 'templates/home.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>