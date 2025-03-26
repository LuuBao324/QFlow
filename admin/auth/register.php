<?php
session_start();

$error_message = $_SESSION['error'] ?? null;
unset($_SESSION['error']);

$role = isset($_GET['role']) ? $_GET['role'] : 'user';
?>