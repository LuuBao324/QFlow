<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

if (!isLoggedIn()) {
    redirect('login.php'); 
}

$question_id = $_POST['id'];

try {
    $question = getDetailedQuestion($pdo, $question_id);
    $userRole = userRole($pdo);

    if ($question['user_id'] != $_SESSION['user_id'] || $userRole != 'admin') {
       redirect('index.php');
    } else{
        if ($question && !empty($question['image'])) {
            $imagepath = $question['image'];
            if (file_exists($imagepath)) {
                unlink($imagepath);
            }
        }
        deleteQuestion($pdo, $question_id);
        redirect('index.php');
    }
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>
    
