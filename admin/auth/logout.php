<?php
require '../../include/session.php';
session_destroy(); 
header('location: admin_login.php') 
?>