<?php
include '../include/session.php';
include '../include/DatabaseConnection.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('location: login.php');
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch();

    if (!$user) {
        $_SESSION['error'] = "User does not exist!";
        header("Location: index.php");
        exit();
    }

    // Update status to 'active'
    $stmt = $pdo->prepare("UPDATE users SET status = 'active' WHERE id = :id");
    $stmt->execute(['id' => $id]);
    
    if ($user['role'] === 'admin') {
        $_SESSION['success'] = "Admin has been enabled successfully!";
    } else {
        $_SESSION['success'] = "User has been enabled successfully!";
    }
    
    header("Location: index.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid ID!";
    header("Location: index.php");
    exit();
}
?>