<?php
include '../include/session.php';
include '../include/DatabaseConnection.php';
include '../include/functions.php'; 


try {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        
        $user = getUserById($pdo, $id); 

        if (!$user) {
            $_SESSION['error'] = "User does not exist!";
            redirect("index.php");
        }

        enableUserAccount($pdo, $id);

        if ($user['role'] === 'admin') {
            $_SESSION['success'] = "Admin has been enabled successfully!";
        } else {
            $_SESSION['success'] = "User has been enabled successfully!";
        }

        redirect("index.php");
    } else {
        $_SESSION['error'] = "Invalid ID!";
        redirect("index.php");
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "An error occurred: " . $e->getMessage();
    redirect("index.php");
}
?>