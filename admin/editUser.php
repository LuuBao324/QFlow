<?php
include '../include/session.php';
include '../include/DatabaseConnection.php';
include '../include/functions.php';

$user_id = $_GET['id'];

try {
    $user = getUserById($pdo, $user_id); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        if (empty($username) || empty($email) || empty($role)) {
            $error = "Please fill in all information.";
        } else {
            if (updateUser($pdo, $user_id, $username, $email, $role)) { 
                redirect("index.php");
            } else {
                $error = "Update error!";
            }
        }
    }

    $title = "Edit User";
    ob_start();
    include 'templates/editUser.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = "Error has occurred";
    $output = "Error: " . $e->getMessage();
}

include 'templates/admin_layout.html.php';
?>

