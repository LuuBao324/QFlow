<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $user_id = $_SESSION['user_id'];
        $module_id = $_POST['module_id'];
        $image = ''; // Handle image upload

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = 'uploads/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
        }

        // $stmt = $pdo->prepare("INSERT INTO questions (user_id, module_id, title, content, image) VALUES (:user_id, :module, :title, :content, :image)");
        // $stmt->bindValue(':user_id', $user_id);
        // $stmt->bindValue(':module_id', $module_id);
        // $stmt->bindValue(':title', $title);
        // $stmt->bindValue(':content', $content);
        // $stmt->bindValue(':image', $image);

        // if ($stmt->execute()) {
        //     redirect('index.php');
        // } else {
        //     $output = "Error posting question.";
        // }
        insertQuestion($pdo, $user_id, $module_id, $title, $content, $image);
        redirect('index.php');
    } else {
        $title = 'Post a Question';
        $modules = allModules($pdo);

        ob_start();
        include 'templates/postquestionform.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>