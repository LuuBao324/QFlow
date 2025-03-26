<?php
 include '../include/DatabaseConnection.php';
 

 $sql = "SELECT id, username, email, role FROM users ORDER BY role DESC, id ASC";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
 include 'templates/admin_layout.html.php';
 ?>

 
 