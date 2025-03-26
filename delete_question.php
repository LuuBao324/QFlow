<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$question_id = $_POST['id'];

try {
    
    // $stmt = $pdo->prepare("SELECT image FROM questions WHERE id = :id");
    // $stmt->bindValue(':id', $question_id);
    // $stmt->execute();
    // $question = $stmt->fetch();
    $question = getImage($pdo, $question_id);
    
    if($question && !empty($question['image'])){
        $imagepath = $question['image'];
        if(file_exists($imagepath)){
            unlink($imagepath);
        }
    }

    // $stmt = $pdo->prepare("DELETE FROM comments WHERE question_id = :question_id");
    // $stmt->bindValue(':question_id', $question_id);
    // $stmt->execute();

    // $stmt = $pdo->prepare("DELETE FROM questions WHERE id = :id");
    // $stmt->bindValue(':id', $question_id);
    deleteQuestion($pdo, $question_id);
    redirect('index.php');
    // if ($stmt->execute()) {
    //     redirect('index.php');
    // } else {
    //     $output = "Error deleting question.";
    // }

    

    
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>