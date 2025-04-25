<?php
require '../../include/session.php';
session_destroy(); // Destroy the session
header('location: admin_login.php') // Redirect to the home page
?>