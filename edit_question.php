<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

if (!isset($_GET['id'])) {
    redirect('index.php');
}

$question_id = $_GET['id'];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $module_id = $_POST['module_id'];
        $image = ''; // Handle image upload

        // if (isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        //     // $stmt = $pdo->prepare("SELECT image FROM questions WHERE id = :id");
        //     // $stmt->bindValue(':id', $question_id);
        //     // $stmt->execute();
        //     // $question = $stmt->fetch();
        //     // $existing_image = $question['image'];
        //     $existing_image = getImage($pdo, $_GET['id']);

        //     if($existing_image && file_exists($existing_image)){
        //         unlink($existing_image);
        //     }
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = 'uploads/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
        }

        // $stmt = $pdo->prepare("UPDATE questions SET title = :title, content = :content, category_id = :category_id, image = :image WHERE id = :id");
        // $stmt->bindValue(':title', $title);
        // $stmt->bindValue(':content', $content);
        // $stmt->bindValue(':category_id', $category_id);
        // $stmt->bindValue(':image', $image);
        // $stmt->bindValue(':id', $question_id);
        updateQuestion($pdo, $question_id, $title, $content, $module_id, $image);
        redirect("index.php");
        // if ($stmt->execute()) {
        //     redirect("index.php");
            
        // } else {
        //     $output = "Error updating question.";
        // }
    } else {
        // Fetch the question details
        // $stmt = $pdo->prepare("SELECT * FROM questions WHERE id = :id");
        // $stmt->bindValue(':id', $question_id);
        // $stmt->execute();
        // $question = $stmt->fetch();
        $question = getAllQuestion($pdo, $question_id);
        $title = 'Edit Question';
        $modules = allModules($pdo);

        ob_start();
        include 'templates/editquestionform.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>