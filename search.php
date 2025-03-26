<?php
require 'include/session.php';
require 'include/DatabaseConnection.php';
require 'include/functions.php';

$query = '';
$title = 'Search Results';

try {
    if (isset($_GET['query'])) {
        $query = $_GET['query'];
        $stmt = $pdo->prepare("SELECT questions.*, users.username FROM questions JOIN users ON questions.user_id = users.id WHERE title LIKE :query OR content LIKE :query");
        $searchTerm = "%$query%";
        $stmt->bindValue(':query', $searchTerm);
        $stmt->execute();
        $questions = $stmt->fetchAll();
    }

    ob_start();
    include 'templates/searchresults.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>