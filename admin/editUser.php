<?php
include '../include/DatabaseConnection.php';
// include '../includes/admin_auth.php';

// if (!isset($_GET['id']) || empty($_GET['id'])) {
//     die("User not found.");
// }

$id = $_GET['id'];

try {
    $query = "SELECT id, username, email, role FROM users WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // if (!$user) {
    //     die("User does not exist.");
    // }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        if (empty($username) || empty($email) || empty($role)) {
            $error = "Please fill in all information.";
        } else {
            $updateQuery = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
            $updateStmt = $pdo->prepare($updateQuery);
            if ($updateStmt->execute([$username, $email, $role, $id])) {
                header("Location: index.php");
                exit();
            } else {
                $error = "Update error!";
            }
        }
    }

    $title = "Edit User";
    ob_start();
    include  'templates/editUser.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = "Error has occurred";
    $output = "Error: " . $e->getMessage();
}

include  'templates/admin_layout.html.php';
?>

