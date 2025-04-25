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
        
        $questions = getFilteredQuestions($pdo, $selectedModules);

    } else {
        // Fetch all questions if no filter is applied
        $questions = getAllQuestions($pdo);
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