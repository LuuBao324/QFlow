<?php
session_start();
include '../../include/DatabaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $confirm_password = trim($_POST['confirm_password']);
    $role = $_POST['role'] ?? 'user';

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Password does not match!";
        header("location: register.php");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    if( $stmt->rowCount() > 0) {
        $_SESSION['error'] = 'Account already exists!';
        header('register.php');
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if( $stmt->rowCount() > 0) {
        $_SESSION['error'] = 'Email has been used!';
        header('register.php');
        exit();
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    try{
        $sql = 'INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'username'=> $username,
            'password'=> $hashed_password,
            'email' => $email,
            'role' => $role
        ]);

        $_SESSION['success'] = "Register succesfully! Please log in.";
        header("location: login.php");
        exit();
    }catch(PDOException $e){
        $_SESSION["error"] = $e->getMessage();
        header("location: register.php");
        exit();
    }
}