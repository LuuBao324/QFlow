<?php
session_start();
if (isset($_SESSION["user_id"]) || $_SESSION["role"] == "admin") {
    header("location: auth/login.php");
}
$username = htmlspecialchars($_SESSION['username'])
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Area</title>
</head>
<body>
    
</body>
</html>