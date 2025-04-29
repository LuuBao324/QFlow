<?php
include '../../include/session.php';
include '../../include/DatabaseConnection.php';
include '../../include/functions.php';

// Check if the current user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    redirect('admin_login.php');
}

$register_error = '';
$register_success = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate username
    $username = trim($_POST['username']);
    if (empty($username)) {
        $errors['username'] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors['username'] = "Username must be at least 3 characters.";
    } else {
        // Check if username already exists
        if (usernameExists($pdo, $username)) { // Use function to check username existence
            $errors['username'] = "Username already taken.";
        }
    }
    
    // Validate email
    $email = trim($_POST['email']);
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    } else {
        // Check if email already exists
        if (emailExists($pdo, $email)) { // Use function to check email existence
            $errors['email'] = "Email address already registered.";
        }
    }
    
    // Validate password
    $password = $_POST['password'];
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    }
    
    // Validate confirm password
    $confirm_password = $_POST['confirm_password'];
    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Please confirm the password.";
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }
    
    // Role
    $role = $_POST['role'];
    $status = 'active'; // Default status for new users
    
    // If no errors, proceed with registration
    if (empty($errors)) {
        try {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new user
            $result = insertUser($pdo, $username, $hashed_password, $email, $role, $status); // Use function to insert user

            if ($result) {
                $register_success = 'User registered successfully!';
                // Reset form values
                $username = '';
                $email = '';
                $password = '';
                $confirm_password = '';
                $role = '';
            } else {
                $register_error = 'Registration failed. Please try again.';
            }
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            $register_error = 'Database error occurred. Please try again later.';
        }
    }
}

include '../templates/admin_register.html.php';
?>