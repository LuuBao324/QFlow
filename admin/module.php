<?php
include '../include/DatabaseConnection.php';
include '../include/functions.php';



try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $moduleName = $_POST['moduleName'];

        $stmt = $pdo ->prepare('INSERT INTO module (moduleName) VALUES (:moduleName)');
        $stmt->bindValue(':moduleName', $moduleName);
        $stmt->execute();  
        header('location: module.php');
        
    }else{
        $title = "Add a module";
        $modules = allModules($pdo);
        ob_start();
        include 'templates/module.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/admin_layout.html.php'
?>