<?php
include '../include/session.php';
include '../include/DatabaseConnection.php';
include '../include/functions.php'; 


try {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $admin_id = $_SESSION['user_id'];

        if ($id == $admin_id) {
            $_SESSION['error'] = "You cannot disable your own account!";
            redirect("index.php");
        }

        $user = getUserById($pdo, $id); 

        if (!$user) {
            $_SESSION['error'] = "User does not exist!";
            redirect("index.php");
        }

        disableUserAccount($pdo, $id); 

        if ($user['role'] === 'admin') {
            $_SESSION['success'] = "Admin has been disabled successfully!";
        } else {
            $_SESSION['success'] = "User has been disabled successfully!";
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