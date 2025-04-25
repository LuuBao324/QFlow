<?php
try{
    include '../include/DatabaseConnection.php';
    include '../include/functions.php';

    $sql = 'DELETE FROM module WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    
    header('location: module.php');
}catch(PDOException $e){
    $title = 'An error has occured';
    $output = 'Unable to connect to delete joke: ' . $e->getMessage();
}
include 'templates/admin_layout.html.php';
?>