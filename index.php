<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

try {
    // Fetch all modules for the filter sidebar
    $modules = allModules($pdo);
    
    // Check if there are selected modules in the session
    if (isset($_SESSION['selected_modules']) && !empty($_SESSION['selected_modules'])) {
        $selectedModules = $_SESSION['selected_modules'];
        
        // Create placeholders for the IN clause
        $placeholders = implode(',', array_fill(0, count($selectedModules), '?'));
        
        // Fetch questions based on selected modules
        $sql = "SELECT questions.*, users.username 
                FROM questions 
                INNER JOIN users ON questions.user_id = users.id
                WHERE questions.module_id IN ($placeholders) 
                ORDER BY questions.created_at DESC";
                
        $stmt = $pdo->prepare($sql);
        $stmt->execute($selectedModules);
        $questions = $stmt->fetchAll();
    } else {
        // Fetch all questions if no filter is applied
        $stmt = $pdo->prepare("SELECT questions.*, users.username 
                             FROM questions 
                             INNER JOIN users ON questions.user_id = users.id
                             ORDER BY questions.created_at DESC");
        $stmt->execute();
        $questions = $stmt->fetchAll();
    }

    ob_start();
    include 'templates/home.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>