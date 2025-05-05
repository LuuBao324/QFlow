<?php
include '../include/DatabaseConnection.php';
include '../include/functions.php';
include '../include/session.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $moduleName = $_POST['moduleName'];

        insertModule($pdo, $moduleName);
        redirect('module.php');
    } else {
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

include 'templates/admin_layout.html.php';
?>