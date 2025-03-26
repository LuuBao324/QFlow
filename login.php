<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
        $stmt->bindValue(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                redirect('index.php');
            } else {
                $output = "Invalid password.";
            }
        } else {
            $output = "User not found.";
        }
    } else {
        $title = 'Login';

        ob_start();
        include 'templates/loginform.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>