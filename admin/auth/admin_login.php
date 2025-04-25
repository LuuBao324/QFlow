<?php
include '../../include/session.php' ;
include '../../include/DatabaseConnection.php';
include '../../include/functions.php';

$login_error = ''; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    try{
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND role = 'admin'");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Check if admin account is active
            if ($user['status'] == 'active') {
                if (password_verify($password, $user['password'])) {
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $user['id']; // Changed to match standard session variable name
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    header('location: ../index.php');
                    exit();
                } else {
                    $login_error = 'Invalid password!';
                }
            } else {
                $login_error = 'This admin account has been disabled!';
            }
        } else {
            $login_error = 'Please login with a valid admin account!';
        }
    } catch(PDOException $e) {
        $login_error = 'Database error, please try again!';
    }
}
include '../templates/admin_login.html.php';
?>