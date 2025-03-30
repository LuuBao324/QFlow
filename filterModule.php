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
    
    // Store the selected modules in the session for persistence
    $_SESSION['selected_modules'] = $selectedModules;
} else {
    // If no modules selected or form not submitted, clear the session filter
    $_SESSION['selected_modules'] = [];
    
    // Fetch all questions if no filter is applied
    $stmt = $pdo->query("SELECT questions.*, users.username 
                         FROM questions 
                         INNER JOIN users ON questions.user_id = users.id
                         ORDER BY questions.created_at DESC");
    $questions = $stmt->fetchAll();
}

// Generate the output
ob_start();
include 'templates/home.html.php';
$output = ob_get_clean();

// Include the layout template
include 'templates/layout.html.php';
?>