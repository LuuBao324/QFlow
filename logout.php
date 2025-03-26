<?php
require 'include/session.php';
session_destroy(); // Destroy the session
header('location: index.php') // Redirect to the home page
?>