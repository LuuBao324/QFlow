<?php
include '../include/session.php';
include '../include/DatabaseConnection.php';

// Check if user is logged in and is an admin (fixed the logic - should be AND not OR)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('location: login.php');
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $admin_id = $_SESSION['user_id'];

    if ($id == $admin_id) {
        $_SESSION['error'] = "You cannot disable your own account!";
        header("Location: index.php");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch();

    if (!$user) {
        $_SESSION['error'] = "User does not exist!";
        header("Location: index.php");
        exit();
    }

    // disable account
    $stmt = $pdo->prepare("UPDATE users SET status = 'disabled' WHERE id = :id");
    $stmt->execute(['id' => $id]);
    
    if ($user['role'] === 'admin') {
        $_SESSION['success'] = "Admin has been disabled successfully!";
    } else {
        $_SESSION['success'] = "User has been disabled successfully!";
    }
    
    header("Location: index.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid ID!";
    header("Location: index.php");
    exit();
}
?>