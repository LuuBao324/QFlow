<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

if (!isset($_GET['id'])) {
    redirect('index.php');
}

$question_id = $_GET['id'];

try {
    
    $question = getDetailedQuestion($pdo, $question_id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $content = $_POST['content'];
        $user_id = $_SESSION['user_id'];
        
        if (!isset($_SESSION['user_id'])) {
            redirect('login.php');
        }
        
        insertComment($pdo, $question_id, $user_id, $content);
        header("Location: comment.php?id=$question_id");
        
    } else {
        $comments = fetchComments($pdo, $question_id);
        $title = htmlspecialchars($question['title']);

        ob_start();
        include 'templates/comment.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>
    
