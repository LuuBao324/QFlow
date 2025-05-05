<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$question_id = $_GET['id'];

try {
    $question = getDetailedQuestion($pdo, $question_id);

    if ($question['user_id'] !== $_SESSION['user_id']) {
        redirect('index.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $module_id = $_POST['module_id'];
        $image = $question['image'];

        // process new image if one is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && !empty($_FILES['image']['name'])) {
            if (!empty($image) && file_exists($image)) {
                unlink($image);
            }
            $image = 'uploads/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
        }

        updateQuestion($pdo, $question_id, $title, $content, $module_id, $image);
        redirect('index.php');
    } else {
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