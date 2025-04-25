<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

// Fetch all modules for the filter sidebar
$modules = allModules($pdo);

// Initialize an empty array for questions
$questions = [];

// Check if the form is submitted and modules are selected
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modules']) && !empty($_POST['modules'])) {
    $selectedModules = $_POST['modules'];
    
 
    $questions = getFilteredQuestions($pdo, $selectedModules);
    
    // Store the selected modules in the session for persistence
    $_SESSION['selected_modules'] = $selectedModules;
} else {
    // If no modules selected or form not submitted, clear the session filter
    $_SESSION['selected_modules'] = [];
    
    $questions = getAllQuestions($pdo);
}

// Generate the output
ob_start();
include 'templates/home.html.php';
$output = ob_get_clean();

// Include the layout template
include 'templates/layout.html.php';
?>