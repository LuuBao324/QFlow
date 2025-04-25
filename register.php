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
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) {
                $errors['username'] = "Username already taken.";
            }
        }
        
        // Validate email
        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid email address.";
        } else {
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) {
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
        
        // If no errors, proceed with registration
        if (empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $hashedPassword);
            $stmt->bindValue(':email', $email);
            
            if ($stmt->execute()) {
                header('Location: login.php');
                exit;
            } else {
                $signup_error = "Registration failed. Please try again.";
            }
        }
    }
    
    // Display the registration form
    include 'templates/registerform.html.php';
    
} catch (PDOException $e) {
    error_log('Database Error: ' . $e->getMessage());
    $signup_error = "A system error occurred. Please try again later.";
    include 'templates/registerform.html.php';
}
?>