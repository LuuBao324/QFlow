<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';


    $login_error = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($username) && !empty($password)) {
            $user = getUser($pdo,$username);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    redirect('index.php');
                } else {
                    $login_error = "Invalid password.";
                }
            } else {
                $login_error = "User not found.";
            }
        }    
    }
include "templates/loginform.html.php"

?>