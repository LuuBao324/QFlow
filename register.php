<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

try {
    $signup_error = '';
    $errors = [];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validate username
        $username = trim($_POST['username']);
        if (strlen($username) < 3) {
            $errors['username'] = "Username must be at least 3 characters.";
        } else {
            // Check if username already exists
            if (usernameExists($pdo, $username)) {
                $errors['username'] = "Username already taken.";
            }
        }
        
        // Validate email
        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid email address.";
        } else {
            // Check if email already exists
            if (emailExists($pdo, $email)) {
                $errors['email'] = "Email address already registered.";
            }
        }
        
        // Validate password
        $password = $_POST['password'];
        if (strlen($password) < 8) {
            $errors['password'] = "Password must be at least 8 characters long.";
        }
        
        // Validate confirm password
        $confirm_password = $_POST['confirm_password'];
        if ($password !== $confirm_password) {
            $errors['confirm_password'] = "Passwords do not match.";
        }

        $role = 'user';
        $status = 'active';
        
        // If no errors, proceed with registration
        if (empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            if (insertUser($pdo, $username, $hashedPassword, $email, $role, $status)) {
                redirect('login.php');
            } else {
                $signup_error = "Registration failed. Please try again.";
            }
        }
    }
    include 'templates/registerform.html.php';
    
} catch (PDOException $e) {
    error_log('Database Error: ' . $e->getMessage());
    $signup_error = "A system error occurred. Please try again later.";
    include 'templates/registerform.html.php';
}
?>