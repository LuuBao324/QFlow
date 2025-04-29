<?php
try { 
    include '../include/session.php';
    include '../include/DatabaseConnection.php';
    include '../include/functions.php'; 

    $users = getAllUsers($pdo); 

    ob_start();
    include 'templates/User_management.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/admin_layout.html.php';
?>


