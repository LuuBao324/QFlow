<?php
session_start();
include '../include/DatabaseConnection.php';

if (isset($_SESSION['user_id']) || $_SESSION['role'] == 'admin') {
    header('location: login.php');
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $admin_id = $_SESSION['user_id'];

    if ($id == $admin_id) {
        $_SESSION['error'] = "You cannot delete your account!";
        header("Location: users.php");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch();

    if (!$user) {
        $_SESSION['error'] = "User does not exist!";
        header("Location: users.php");
        exit();
    }

    if ($user['role'] === 'admin') {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $_SESSION['success'] = "Admin has been deleted successfully!";
        header("Location: users.php");
    } else {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $_SESSION['success'] = "User has been deleted successfully!";
        header("Location: users.php");
    }
} else {
    $_SESSION['error'] = "Invalid ID!";
    header("Location: users.php");
    exit();
}
?>