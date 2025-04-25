<?php
try{ 
include '../include/DatabaseConnection.php';
 

 $sql = "SELECT * FROM users ORDER BY role DESC, id ASC";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

 ob_start();
 include 'templates/User_management.html.php';
 $output = ob_get_clean();
}catch(PDOException $e){
    $title = 'An error has occured';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/admin_layout.html.php';
 ?>

 
 