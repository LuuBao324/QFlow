<?php
try{
    include '../include/session.php';
    include '../include/DatabaseConnection.php';
    include '../include/functions.php';

    $module_id = $_GET['id'];

    deleteModule($pdo, $module_id);
    header('location: module.php');
} catch(PDOException $e){
    $title = 'An error has occured';
    $output = 'Unable to connect to delete module: ' . $e->getMessage();
}
include 'templates/admin_layout.html.php';
?>