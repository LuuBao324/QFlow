<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

try {
    $signup_error = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];

        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':email', $email);

        if ($stmt->execute()) {
            redirect('login.php');
        } else {
            $signup_error = "Registration failed.";
        }
    } else {

        include 'templates/registerform.html.php';
        
    }
} catch (PDOException $e) {
    echo'Error: ' . $e->getMessage();
}


?>