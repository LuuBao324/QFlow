<?php
session_start();
include ("../../include/DatabaseConnection.php");
include ("../../include/functions.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    try{
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND role = 'admin'");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])){
            session_regenerate_id(true);
            $_SESSION['userid'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('location: ../index.php');
            exit();
        }else{
            $error = 'Please login as admin account!';
        }
    }catch(PDOException $e){
        $error = 'Error, please try again!';
    }
}