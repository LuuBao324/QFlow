<?php
include '../include/DatabaseConnection.php';
// include '../includes/admin_auth.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ User not found.");
}

$id = $_GET['id'];

$query = "SELECT id, username, email, role FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("❌ User does not exist.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if (empty($username) || empty($email) || empty($role)) {
        echo "⚠ Please fill in all information.";
    } else {
        $updateQuery = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
        $updateStmt = $pdo->prepare($updateQuery);
        if ($updateStmt->execute([$username, $email, $role, $id])) {
            echo "✅ Updated successfully!";
            header("Location: users.php");
            exit();
        } else {
            echo "❌ Update error!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background with a soft gradient */
        body {
            background: linear-gradient(135deg, #F9a9e, #fad0c4, #FF758c, #FF7eb3);
            color: black;
        }
    </style>
</head>
<body>
    <h1>Edit User</h1>
</body>
</html>
