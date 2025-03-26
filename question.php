<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

if (!isset($_GET['id'])) {
    redirect('index.php');
}

$question_id = $_GET['id'];

try {
    // Fetch the question details
    // $stmt = $pdo->prepare("SELECT questions.*, users.username FROM questions JOIN users ON questions.user_id = users.id WHERE questions.id = :id");
    // $stmt->bindValue(':id', $question_id);
    // $stmt->execute();
    // $question = $stmt->fetch();
    $question = getDetailedQuestion($pdo, $question_id);

    // if (!$question) {
    //     echo "Question not found.";
    //     exit;
    // }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $content = $_POST['content'];
        $user_id = $_SESSION['user_id'];

        // $stmt = $pdo->prepare("INSERT INTO comments (question_id, user_id, content) VALUES (:question_id, :user_id, :content)");
        // $stmt->bindValue(':question_id', $question_id);
        // $stmt->bindValue(':user_id', $user_id);
        // $stmt->bindValue(':content', $content);

        insertComment($pdo, $question_id, $user_id, $content);
        redirect("question.php?id=$question_id");
        
    } else {
        // Fetch comments for the question
        // $comments_stmt = $pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.question_id = :question_id");
        // $comments_stmt->bindValue(':question_id', $question_id);
        // $comments_stmt->execute();
        // $comments = $comments_stmt->fetchAll();
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